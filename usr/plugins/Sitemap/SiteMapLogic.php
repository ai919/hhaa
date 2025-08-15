<?php


class SiteMapLogic
{

    private string $header;

    private string $nodes;

    /**
     * 初始化
     * SiteMapLogic constructor.
     * @param $template
     */
    public function __construct($template)
    {
        $this->header = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $this->header .= "<?xml-stylesheet type='text/xsl' href='{$template}'?>\n";
        $this->nodes  = '';
    }

    /**
     * 设置节点
     * @param        $loc
     * @param null   $lastmod
     * @param string $changefreq
     * @param float  $priority
     */
    public function setNode($loc, $lastmod = null, $changefreq = 'always', $priority = 0.7)
    {
        $loc        = htmlspecialchars($loc, ENT_XML1 | ENT_COMPAT, 'UTF-8');
        $changefreq = htmlspecialchars($changefreq, ENT_XML1 | ENT_COMPAT, 'UTF-8');
        $priority   = is_numeric($priority) ? max(0.0, min((float) $priority, 1.0)) : 0.7;

        $lastmod    = $lastmod ?: time();
        $this->nodes .= "\t<url>\n" .
            "\t\t<loc>{$loc}</loc>\n" .
            "\t\t<lastmod>" . date('c', $lastmod) . "</lastmod>\n" .
            "\t\t<changefreq>{$changefreq}</changefreq>\n" .
            "\t\t<priority>{$priority}</priority>\n" .
            "\t</url>\n";
    }

    /**
     * 生成
     * @return string
     */
    public function generate(): string
    {
        $this->header .= "<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\nxsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\"\nxmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";

        return $this->header . $this->nodes . "</urlset>";
    }

    /**
     * 输出
     */
    public function output(): void
    {
        header("Content-Type: application/xml");
        echo $this->generate();
    }

}
