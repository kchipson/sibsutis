<?xml version="1.0" encoding="WINDOWS-1251"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
 <UL>
  <xsl:for-each select="shop/product_type">
   <LI/><b><xsl:value-of select="@caption"/>:</b>
   <p/>
   <OL>
     <xsl:for-each select="product"> 
     <LI/><xsl:value-of select="."/>
     </xsl:for-each> 
   <p/>
   </OL> 
  </xsl:for-each>  
 </UL>     
</xsl:template>
</xsl:stylesheet>