<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="text" />
    <xsl:strip-space elements="*"/>
    
    <xsl:template match="h1|h3|h4">
        <xsl:value-of select="." />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="h2">
        <xsl:number format="1. " level="multiple" count="h2"/>
        <xsl:value-of select="." />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>

    <xsl:template match="p">
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
        <xsl:text>&#xA;</xsl:text>
        <xsl:value-of select="p" />
    </xsl:template>

    <xsl:template match="div[@class='firmas']">
        <!--<xsl:text>&#xA;</xsl:text>-->
        <!--<xsl:text>&#xA;</xsl:text>-->
        <!--<xsl:text>&#xA;</xsl:text>-->
        <!--<xsl:apply-templates select="div[@class='firma']" />-->
    </xsl:template>

<!--    <xsl:template match="div[@class='firmas']/div[@class='firma']">
        <xsl:text>- </xsl:text>
        <xsl:value-of select="div[@class='nombre']" />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>  </xsl:text>
        <xsl:value-of select="div[@class='cargo']" />
        <xsl:text>&#xA;</xsl:text>
    </xsl:template>-->
</xsl:stylesheet>
