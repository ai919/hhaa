<?php
include_once __DIR__ . "/SiteMapLogic.php";

class Sitemap_Action extends Typecho_Widget implements Widget_Interface_Do
{

    public function action()
    {
        switch ($this->request->action) {
            case 'tags':
                $this->tags();
                break;
            case 'category':
                $this->category();
                break;
            default:
                $this->sitemap();
                break;
        }
    }

    private function sitemap()
    {
        $db      = Typecho_Db::get();
        $options = Typecho_Widget::widget('Widget_Options');

        try {
            $pluginOptions = $options->plugin('Sitemap');
        } catch (Exception $e) {
            $pluginOptions = Typecho_Config::factory([
                'updateTip' => '1',
                'cacheTime' => '86400',
                'flushCache' => '0',
            ]);
            error_log('Sitemap plugin config missing, using defaults: ' . $e->getMessage());
        }
        $cacheFile     = __DIR__ . '/cache/sitemap.xml';
        $cacheTime     = isset($pluginOptions->cacheTime) ? (int)$pluginOptions->cacheTime : 0;

        // use cache if available and not expired unless forced to refresh
        if (!$this->request->get('refresh') && $cacheTime > 0 && file_exists($cacheFile)
            && time() - filemtime($cacheFile) < $cacheTime) {
            header('Content-Type: application/xml');
            echo file_get_contents($cacheFile);
            return;
        }

        $template     = $options->pluginUrl . "/Sitemap/sitemap.xsl";
        $siteMapLogic = new SiteMapLogic($template);

        /* 拆分tag */
        $tags_xml = Typecho_Common::url('/tags.xml', $options->index);
        $siteMapLogic->setNode($tags_xml);

        /* 拆分category */
        $tags_xml = Typecho_Common::url('/category.xml', $options->index);
        $siteMapLogic->setNode($tags_xml);

        /* 分页信息 */
        $select = $db->select()->from('table.contents')
            ->where('table.contents.type = ?', 'page')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.password IS NULL')
            ->where('table.contents.created < ?', $options->gmtTime)
            ->order('table.contents.created', Typecho_Db::SORT_DESC);
        $pages  = $db->fetchAll($select);
        foreach ($pages as $page) {
            $type              = $page['type'];
            $routeExists       = (NULL != Typecho_Router::get($type));
            $page['pathinfo']  = $routeExists ? Typecho_Router::url($type, $page) : '#';
            $page['permalink'] = Typecho_Common::url($page['pathinfo'], $options->index);
            $siteMapLogic->setNode($page['permalink'], $page['modified']);
        }

        /* 文章列表 */
        $select   = $db->select()->from('table.contents')
            ->where('table.contents.type = ?', 'post')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.password IS NULL')
            ->where('table.contents.created < ?', $options->gmtTime)
            ->order('table.contents.created', Typecho_Db::SORT_DESC);
        $articles = $db->fetchAll($select);
        foreach ($articles as $article) {
            $type                  = $article['type'];
            $article['categories'] = $db->fetchAll($db->select()->from('table.metas')
                ->join('table.relationships', 'table.relationships.mid = table.metas.mid')
                ->where('table.relationships.cid = ?', $article['cid'])
                ->where('table.metas.type = ?', 'category')
                ->order('table.metas.order', Typecho_Db::SORT_ASC));
            $article['category']   = urlencode(current(Typecho_Common::arrayFlatten($article['categories'], 'slug')));
            $article['slug']       = urlencode($article['slug']);
            $article['date']       = new Typecho_Date($article['created']);
            $article['year']       = $article['date']->year;
            $article['month']      = $article['date']->month;
            $article['day']        = $article['date']->day;
            $routeExists           = (NULL != Typecho_Router::get($type));
            $article['pathinfo']   = $routeExists ? Typecho_Router::url($type, $article) : '#';
            $article['permalink']  = Typecho_Common::url($article['pathinfo'], $options->index);
            $siteMapLogic->setNode($article['permalink'], $article['modified'], 'monthly', 0.6);
        }

        $xml = $siteMapLogic->generate();

        // write cache
        if ($cacheTime > 0) {
            if (!is_dir(dirname($cacheFile))) {
                @mkdir(dirname($cacheFile), 0755, true);
            }
            file_put_contents($cacheFile, $xml);
        }

        header('Content-Type: application/xml');
        echo $xml;
    }

    /**
     * 标签地图
     * @throws Typecho_Db_Exception|Typecho_Exception
     */
    public function tags()
    {
        $db      = Typecho_Db::get();
        $options = Typecho_Widget::widget('Widget_Options');

        $template     = $options->pluginUrl . "/Sitemap/sitemap.xsl";
        $siteMapLogic = new SiteMapLogic($template);

        $select = $db->select()->from('table.metas')
            ->where('table.metas.type = ?', 'tag')
            ->order('table.metas.count', Typecho_Db::SORT_DESC);
        $tags   = $db->fetchAll($select);

        /* 获取每个标签的最新修改时间 */
        $mids = array_column($tags, 'mid');
        $lastModMap = [];
        if (!empty($mids)) {
            $lastModRows = $db->fetchAll($db->select('table.relationships.mid', 'MAX(table.contents.modified) AS modified')
                ->from('table.contents')
                ->join('table.relationships', 'table.contents.cid = table.relationships.cid')
                ->where('table.contents.status = ?', 'publish')
                ->where('table.relationships.mid IN ?', $mids)
                ->group('table.relationships.mid'));
            foreach ($lastModRows as $row) {
                $lastModMap[$row['mid']] = $row['modified'];
            }
        }

        foreach ($tags as $tag) {
            $type     = $tag['type'];
            $lastMod  = $lastModMap[$tag['mid']] ?? null;
            $routeExists      = (NULL != Typecho_Router::get($type));
            $tag['pathinfo']  = $routeExists ? Typecho_Router::url($type, $tag) : '#';
            $tag['permalink'] = Typecho_Common::url($tag['pathinfo'], $options->index);
            $siteMapLogic->setNode($tag['permalink'], $lastMod);
        }
        $siteMapLogic->output();
    }

    /**
     *
     * 分类
     * @throws Typecho_Db_Exception
     * @throws Typecho_Exception
     */
    public function category()
    {
        $db      = Typecho_Db::get();
        $options = Typecho_Widget::widget('Widget_Options');

        $template     = $options->pluginUrl . "/Sitemap/sitemap.xsl";
        $siteMapLogic = new SiteMapLogic($template);

        $select   = $db->select()->from('table.metas')
            ->where('table.metas.type = ?', 'category')
            ->order('table.metas.mid');
        $category = $db->fetchAll($select);

        /* 获取每个分类的最新修改时间 */
        $mids = array_column($category, 'mid');
        $lastModMap = [];
        if (!empty($mids)) {
            $lastModRows = $db->fetchAll($db->select('table.relationships.mid', 'MAX(table.contents.modified) AS modified')
                ->from('table.contents')
                ->join('table.relationships', 'table.contents.cid = table.relationships.cid')
                ->where('table.contents.status = ?', 'publish')
                ->where('table.relationships.mid IN ?', $mids)
                ->group('table.relationships.mid'));
            foreach ($lastModRows as $row) {
                $lastModMap[$row['mid']] = $row['modified'];
            }
        }

        foreach ($category as $cate) {
            $type    = $cate['type'];
            $lastMod = $lastModMap[$cate['mid']] ?? null;

            $routeExists       = (NULL != Typecho_Router::get($type));
            $cate['pathinfo']  = $routeExists ? Typecho_Router::url($type, $cate) : '#';
            $cate['permalink'] = Typecho_Common::url($cate['pathinfo'], $options->index);

            $siteMapLogic->setNode($cate['permalink'], $lastMod, 'always', 0.8);

        }
        $siteMapLogic->output();
    }
}
