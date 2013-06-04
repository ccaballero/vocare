<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="text" indent="no" />

    <xsl:template match="table">
        <xsl:text></xsl:text>
    </xsl:template>

    <xsl:template match="ul/li">
        <xsl:text>* </xsl:text><xsl:value-of select="." />
    </xsl:template>

    <xsl:template match="ol/li">
        <xsl:value-of select="count(preceding-sibling::*)+1"/>
        <xsl:text>) </xsl:text>
        <xsl:value-of select="." />
    </xsl:template>

    <xsl:template match="div[@class='fecha']">
        <xsl:value-of select="p" />
    </xsl:template>

    <xsl:template match="div[@class='firmas']/div[@class='firma']">
        <xsl:text>* </xsl:text>
        <xsl:value-of select="div[@class='nombre']" />
        <xsl:text>&#xA;</xsl:text>
        <xsl:text>      </xsl:text>
        <xsl:value-of select="div[@class='cargo']" />
    </xsl:template>
</xsl:stylesheet>
