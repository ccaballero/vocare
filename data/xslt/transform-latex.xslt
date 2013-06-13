<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="text" />
    <xsl:strip-space elements="*"/>

    <xsl:template match="/">
        <xsl:text>\documentclass[letterpaper,11pt]{article}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\usepackage[spanish]{babel}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\usepackage[utf8]{inputenc}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\usepackage[left=2.5cm,top=2cm,right=2.5cm,bottom=2cm]{geometry}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\usepackage{enumerate}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\usepackage{multirow}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\usepackage{url}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\title{</xsl:text>
        <xsl:apply-templates select="//h1" mode="pre-process" />
        <xsl:text>}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\date{}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\begin{document}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\maketitle</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:apply-templates select="*" />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\end{document}</xsl:text>
    </xsl:template>

    <xsl:template match="h1" mode="pre-process">
        <xsl:apply-templates />
        <xsl:text>\\</xsl:text>
    </xsl:template>

    <xsl:template match="h1"></xsl:template>

    <xsl:template match="h2">
        <xsl:text>\section{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="h3">
        <xsl:text>\subsection{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="h4">
        <xsl:text>\subsubsection{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="p">
        <xsl:apply-templates />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>
    
    <xsl:template match="p" mode="inside-li">
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="table">
        <xsl:text>\begin{tabular}</xsl:text>
        <xsl:value-of select="@latex" />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\hline</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:apply-templates select="tr" />
        <xsl:text>\end{tabular}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="tr">
        <xsl:apply-templates select="th" />
        <xsl:apply-templates select="td" />
        <xsl:text>\\</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\hline</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="tr/th">
        <xsl:text> </xsl:text>
        <xsl:text>\textbf{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>}</xsl:text>
        <xsl:text> </xsl:text>
        <xsl:if test="not(position()=last())">
            <xsl:text>&#38;</xsl:text>
        </xsl:if>
    </xsl:template>

    <xsl:template match="tr/th[@colspan]">
        <xsl:text> \multicolumn{</xsl:text>
        <xsl:value-of select="@colspan" />
        <xsl:text>}{|l|}{\textbf{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>}} </xsl:text>
    </xsl:template>

    <xsl:template match="tr/td">
        <xsl:text> </xsl:text>
        <xsl:apply-templates />
        <xsl:text> </xsl:text>
        <xsl:if test="not(position()=last())">
            <xsl:text>&#38;</xsl:text>
        </xsl:if>
    </xsl:template>

    <xsl:template match="tr/td[@colspan]">
        <xsl:text> \multicolumn{</xsl:text>
        <xsl:value-of select="@colspan" />
        <xsl:text>}{|l|}{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>} </xsl:text>
    </xsl:template>

    <xsl:template match="ol">
        <xsl:text>\begin{enumerate}[a)]</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:apply-templates select="li" />
        <xsl:text>\end{enumerate}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="ul">
        <xsl:text>\begin{itemize}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:apply-templates select="li" />
        <xsl:text>\end{itemize}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="ol/li|ul/li">
        <xsl:text>\item </xsl:text>
        <xsl:apply-templates select="p" mode="inside-li" />
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="div[@class='fecha']">
        <xsl:text>\vspace{4cm}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\begin{center}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:value-of select="p" />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\end{center}</xsl:text>
    </xsl:template>

    <xsl:template match="div[@class='firmas']">
        <xsl:text>&#xA;</xsl:text>
        <xsl:apply-templates select="div[@class='firma']" />
    </xsl:template>

    <xsl:template match="div[@class='firmas']/div[@class='firma']">
        <xsl:if test="position() mod 2 = 1">
            <xsl:text>&#xA;</xsl:text>
            <xsl:text>\vspace{4cm}</xsl:text>
            <xsl:text>&#xA;</xsl:text>
            <xsl:text>&#xA;</xsl:text>
        </xsl:if>
        <xsl:text>\begin{minipage}[b]{0.5\textwidth}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\begin{center}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>{\bf </xsl:text>
        <xsl:value-of select="div[@class='nombre']" />
        <xsl:text>}\\</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:value-of select="div[@class='cargo']" />
        <xsl:text>\\</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\end{center}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\end{minipage}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="strong">
        <xsl:text>\textbf{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>}</xsl:text>
    </xsl:template>

    <xsl:template match="a">
        <xsl:text> \url{</xsl:text>
        <xsl:apply-templates />
        <xsl:text>}</xsl:text>
    </xsl:template>

    <!-- text -->
    <xsl:template match="text()">
        <!--
        per latex tutorial, the following need escaping: # $ % & ~ _ ^ \ { }
        -->
        <xsl:call-template name="esc">
            <xsl:with-param name="c" select='"#"'/>
            <xsl:with-param name="s">
                <xsl:call-template name="esc">
                    <xsl:with-param name="c" select='"$"'/>
                    <xsl:with-param name="s">
                        <xsl:call-template name="esc">
                            <xsl:with-param name="c" select='"%"'/>
                            <xsl:with-param name="s">
                                <xsl:call-template name="esc">
                                    <xsl:with-param name="c" select='"&amp;"'/>
                                    <xsl:with-param name="s">
                                        <xsl:call-template name="esc">
                                            <xsl:with-param name="c" select='"~"'/>
                                            <xsl:with-param name="s">
                                                <xsl:call-template name="esc">
                                                    <xsl:with-param name="c" select='"_"'/>
                                                    <xsl:with-param name="s">
                                                        <xsl:call-template name="esc">
                                                            <xsl:with-param name="c" select='"^"'/>
                                                            <xsl:with-param name="s">
                                                                <xsl:call-template name="esc">
                                                                    <xsl:with-param name="c" select='"{"'/>
                                                                    <xsl:with-param name="s">
                                                                        <xsl:call-template name="esc">
                                                                            <xsl:with-param name="c" select='"}"'/>
                                                                            <xsl:with-param name="s">
                                                                                <xsl:call-template name="esc">
                                                                                    <xsl:with-param name="c" select='"\"'/>
                                                                                    <xsl:with-param name="s" select='.'/>
                                                                                </xsl:call-template>
                                                                            </xsl:with-param>
                                                                        </xsl:call-template>
                                                                    </xsl:with-param>
                                                                </xsl:call-template>
                                                            </xsl:with-param>
                                                        </xsl:call-template>
                                                    </xsl:with-param>
                                                </xsl:call-template>
                                            </xsl:with-param>
                                        </xsl:call-template>
                                    </xsl:with-param>
                                </xsl:call-template>
                            </xsl:with-param>
                        </xsl:call-template>
                    </xsl:with-param>
                </xsl:call-template>
            </xsl:with-param>
        </xsl:call-template>
    </xsl:template>

    <xsl:template name="esc">
        <xsl:param name="s"/>
        <xsl:param name="c"/>
        <xsl:choose>
            <xsl:when test='contains($s, $c)'>
                <xsl:value-of select='substring-before($s, $c)'/>
                <xsl:text>\</xsl:text>
                <xsl:choose>
                    <xsl:when test='$c = "\"'>
                        <xsl:text>textbackslash </xsl:text>
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:value-of select='normalize-space($c)'/>
                        <xsl:text>  </xsl:text>
                    </xsl:otherwise>
                </xsl:choose>
                <xsl:call-template name="esc">
                    <xsl:with-param name='c' select='$c'/>
                    <xsl:with-param name='s' select='substring-after($s, $c)'/>
                </xsl:call-template>
            </xsl:when>
            <xsl:otherwise>
                <xsl:value-of select='normalize-space($s)'/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
</xsl:stylesheet>
