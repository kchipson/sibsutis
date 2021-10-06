<?xml version="1.0" encoding="WINDOWS-1251"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/shop">

    <table width="60%" bgcolor="#CCCCCC" align="center" border="1" cellpadding="2">
        <tr align="center">
        <td>#</td>
          <xsl:for-each select="product_type"> 
           <td><b><i><xsl:value-of select="@caption"/></i></b></td>
          </xsl:for-each> 
        </tr> 
        
          <xsl:for-each select="product_type[1]/product">
            <tr align="center" bgcolor="#F5F5F5"> 
                <xsl:variable name="pos" select="position()"/>
                <td><xsl:value-of select="$pos"/></td>
                <td><xsl:value-of select="."/></td>
                <td><xsl:value-of select="/shop/product_type[2]/product[$pos]"/></td>
            </tr>
          </xsl:for-each>        
    </table>
    
</xsl:template>
</xsl:stylesheet>