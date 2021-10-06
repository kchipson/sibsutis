<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/solar">

    <table width="60%" bgcolor="#BFDBB5" align="center" border="1" style="border-collapse: collapse;" cellpadding="2">

        <xsl:variable name="year" select="planet/circulation_period/@unit"/>
        <xsl:variable name="y" select="substring-before($year,'о')"/>
        <xsl:variable name="hour" select="planet/revolution_period/@unit"/>
        <xsl:variable name="h" select="substring-before($hour,'а')"/>

        <tr align="center" bgcolor="#B5BCDB" style="font-weight: bold;">
        <td>№</td>
        <td>Название</td>
        <td>Расстояние<br/>от солнца<br/>
        (<xsl:value-of select="planet/distance/@unit"/>)
        </td>
        <td>Период<br/>обращения<br/>
        (<xsl:value-of select="$y"/>.)
        </td>
        <td>Период<br/>вращения<br/>вокруг своей<br/>
        оси (<xsl:value-of select="$h"/>.)
        </td>
        <td>Масса<br/>относительно<br/>Земли</td>
        <td>Диаметр<br/>
        (<xsl:value-of select="planet/diametr/@unit"/>.)</td>
        <td>Количество<br/>спутников</td>
        </tr> 

        <xsl:for-each select="planet">
    
        <!-- <xsl:if test="diametr &lt; 10000"> -->
        <xsl:sort data-type="number" select="satellite_number"/>
        <xsl:sort data-type="text" select="@caption"/>
        <xsl:variable name="pos" select="position()"/>
                
        <xsl:choose>
            <xsl:when test="(diametr div 2) &lt; 10000">
                <tr align="center" bgcolor="#B5DBC1" > 
                    <td><xsl:value-of select="$pos"/></td>
                    <td><xsl:value-of select="@caption"/></td>
                    <td><xsl:value-of select="distance"/></td>
                    <td><xsl:value-of select="circulation_period"/></td>
                    <td><xsl:value-of select="revolution_period"/></td>
                    <td><xsl:value-of select="weight"/></td>
                    <td><xsl:value-of select="diametr"/></td>
                    <td><xsl:value-of select="satellite_number"/></td>
                </tr>
            </xsl:when>

            <xsl:otherwise>
                <tr align="center" bgcolor="#DBB5B5">
                <td><xsl:value-of select="$pos"/></td>
                <td><xsl:value-of select="@caption"/></td>
                <td><xsl:value-of select="distance"/></td>
                <td><xsl:value-of select="circulation_period"/></td>
                <td><xsl:value-of select="revolution_period"/></td>
                <td><xsl:value-of select="weight"/></td>
                <td><xsl:value-of select="diametr"/></td>
                <td><xsl:value-of select="satellite_number"/></td>
                </tr>
            </xsl:otherwise>

        </xsl:choose>
   
        </xsl:for-each>
    </table>

</xsl:template>
</xsl:stylesheet>