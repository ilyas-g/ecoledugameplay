<?xml version="1.0" encoding="UTF-8"?>
	<xsl:stylesheet version="2.0"
		xmlns:html="http://www.w3.org/TR/REC-html40"
		xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
		xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
		xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="html" encoding="UTF-8" indent="yes"/>

	<!--
	  Set variables for whether lastmod, changefreq or priority occur for any url in the sitemap.
	  We do this up front because it can be expensive in a large sitemap.
	  -->
	<xsl:variable name="has-lastmod"    select="count( /sitemap:urlset/sitemap:url/sitemap:lastmod )"    />
	<xsl:variable name="has-changefreq" select="count( /sitemap:urlset/sitemap:url/sitemap:changefreq )" />
	<xsl:variable name="has-priority"   select="count( /sitemap:urlset/sitemap:url/sitemap:priority )"   />

    
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>XML Sitemap : France</title>
				<style>
					
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            color: #444;
        }
    
        #sitemap__table {
            border: solid 1px #ccc;
            border-collapse: collapse;
        }
    
        #sitemap__table tr td.loc {
            /*
             * URLs should always be LTR.
             * See https://core.trac.wordpress.org/ticket/16834
             * and https://core.trac.wordpress.org/ticket/49949
             */
            direction: ltr;
        }
    
        #sitemap__table tr th {
            text-align: left;
        }
    
        #sitemap__table tr td,
        #sitemap__table tr th {
            padding: 10px;
        }
    
        #sitemap__table tr:nth-child(odd) td {
            background-color: #eee;
        }
    
        a:hover {
            text-decoration: none;
        }
    
				</style>
			</head>
			<body>
				<div id="sitemap">
					<div id="sitemap__header">
						<h1>XML Sitemap : France</h1>
						<p>Ce sitemap XML est généré par SEOKEY pour rendre votre contenu plus visible pour les moteurs de recherche. - <a target="_blank" href="https://www.sitemaps.org/">En savoir plus sur les Sitemaps XML.</a></p>
						<xsl:if test="count(sitemap:sitemapindex/sitemap:sitemap) &lt; 1">
						    <p><a href="/ecoleDuGampelay/wp-content/uploads/seokey/sitemaps/sitemap-index-FRA.xml">Revenir à l’index du sitemap.</a></p>
						</xsl:if>
					</div>
					<div id="sitemap__content">
					    <xsl:if test="count(sitemap:sitemapindex/sitemap:sitemap) &gt; 0">
                            <p class="text">
                            	Ce fichier d’index de sitemap XML contient <strong><xsl:value-of select="count(sitemap:sitemapindex/sitemap:sitemap)"/> sitemaps</strong>
                            </p>
                            <p class="text">
                                 <strong>Pas besoin de soumettre manuellement ce sitemap à Google. SEOKEY s’en chargera pour vous si vous connectez votre Search Console.</strong>
                            </p>
                            <table id="sitemap__table">
                                <thead>
                                <tr>
                                    <th class="loc" width="75%">Sitemap</th>
                                    <th class="lastmod" width="25%">Last Modified</th>
                                </tr>
                                </thead>
                                <tbody>
                                <xsl:for-each select="sitemap:sitemapindex/sitemap:sitemap">
                                    <tr>
                                        <td class="loc">
                                            <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                                        </td>
                                        <td class="lastmod">
                                           <xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)),concat(' ', substring(sitemap:lastmod,20,6)))"/>
                                        </td>
                                    </tr>
                                </xsl:for-each>
                                </tbody>
                            </table>
                        </xsl:if>
                        <xsl:if test="count(sitemap:sitemapindex/sitemap:sitemap) &lt; 1">
                            <p class="text">Nombre d’URL dans ce sitemap XML : <strong><xsl:value-of select="count( sitemap:urlset/sitemap:url )" /> contenu.</strong></p>
                            <p class="text"> <strong>Pas besoin de soumettre manuellement ce sitemap à Google. SEOKEY s’en chargera pour vous si vous connectez votre Search Console.</strong></p>
                            <table id="sitemap__table">
                                <thead>
                                    <tr>
                                        <th class="loc">URL</th>
                                        <xsl:if test="$has-lastmod">
                                            <th class="lastmod">Dernière modification</th>
                                        </xsl:if>
                                        <xsl:if test="$has-changefreq">
                                            <th class="changefreq">Changer la fréquence</th>
                                        </xsl:if>
                                        <xsl:if test="$has-priority">
                                            <th class="priority">Priorité</th>
                                        </xsl:if>
                                        <th class="images">Images</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:for-each select="sitemap:urlset/sitemap:url">
                                        <tr>
                                            <td class="loc"><a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc" /></a></td>
                                            <xsl:if test="$has-lastmod">
                                                <td class="lastmod"><xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)),concat(' ', substring(sitemap:lastmod,20,6)))"/></td>
                                            </xsl:if>
                                            <xsl:if test="$has-changefreq">
                                                <td class="changefreq"><xsl:value-of select="sitemap:changefreq" /></td>
                                            </xsl:if>
                                            <xsl:if test="$has-priority">
                                                <td class="priority"><xsl:value-of select="sitemap:priority" /></td>
                                            </xsl:if>
                                            <xsl:variable name="has-images" select="count(image:image)" />
                                            <xsl:choose>
                                                <xsl:when test="$has-images">
                                                    <td class="images"><xsl:value-of select="count(image:image)"/> Images</td>
                                                </xsl:when>
                                                <xsl:otherwise>
                                                    <td class="images">-</td>
                                                </xsl:otherwise>
                                            </xsl:choose>
                                        </tr>
                                    </xsl:for-each>
                                </tbody>
                            </table>
                        </xsl:if>
					</div>
				</div>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
