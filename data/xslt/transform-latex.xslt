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
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\title{</xsl:text>
        <xsl:value-of select="normalize-space(vocare/h1/text())" />
        <xsl:text>}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\date{}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>\begin{document}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:apply-templates select="*" />
    </xsl:template>

    <xsl:template match="h1">
        <xsl:text>\maketitle</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="h2">
        <xsl:text>\section{</xsl:text>
        <xsl:value-of select="normalize-space()" />
        <xsl:text>}</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="h3|h4|p">
        <xsl:value-of select="normalize-space()" />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="table">
        <xsl:apply-templates select="tr" />
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="tr">
        <xsl:apply-templates select="th" />
        <xsl:apply-templates select="td" />
        <xsl:text>|</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="td|th">
        <xsl:text>| </xsl:text>
        <xsl:value-of select="normalize-space()" />
        <xsl:text> </xsl:text>
    </xsl:template>

    <xsl:template match="ol|ul">
        <xsl:apply-templates select="li" />
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="ul/li">
        <xsl:text>* </xsl:text>
        <xsl:value-of select="normalize-space()" />
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="ol/li">
        <xsl:value-of select="count(preceding-sibling::*)+1"/>
        <xsl:text>) </xsl:text>
        <xsl:value-of select="normalize-space()"/>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="div[@class='fecha']">
        <xsl:value-of select="p" />
    </xsl:template>

    <xsl:template match="div[@class='firmas']">
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
        <xsl:apply-templates select="div[@class='firma']" />
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="div[@class='firmas']/div[@class='firma']">
        <xsl:text>- </xsl:text>
        <xsl:value-of select="div[@class='nombre']" />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>  </xsl:text>
        <xsl:value-of select="div[@class='cargo']" />
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>
</xsl:stylesheet>
