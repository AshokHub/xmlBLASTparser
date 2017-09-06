![xmlBLASTparser](https://raw.githubusercontent.com/AshokHub/xmlBLASTparser/master/misc/xmlBLASTparser_logo_500x125.png)

# [About](../master/README.md)
The [xmlBLASTparser](https://github.com/AshokHub/xmlBLASTparser) is a lightweight PHP library for parsing an XML formatted BLAST output into a colorful HTML page. The database accession number/id in the webpage is properly hyperlinked to the external source database. Moreover, the description summary in the webpage is hyperlinked with anchor link to the corresponding alignment section. The complete list of NCBI standard sequence identifiers are tabulated below:

| **Tag and Identifier Syntax**                          | **Identifier Source Description**                          |
|--------------------------------------------------------|------------------------------------------------------------|
| **bbm**&#124;*integer*                                 | NCBI GenInfo Backbone database identifier                  |
| **bbs**&#124;*integer*                                 | NCBI GenInfo Backbone database identifier                  |
| **dbj**&#124;*coll-accession*&#124;*locus*             | DNA Database of Japan                                      |
| **emb**&#124;*coll-accession*&#124;*entry*             | EBI EMBL Database                                          |
| **gb**&#124;*coll-accession*&#124;*locus*              | NCBI GenBank database                                      |
| **gi**&#124;*integer*                                  | NCBI GenInfo Integrated Database (&ldquo;*jee-aye*&rdquo;) |
| **gim**&#124;*integer*                                 | NCBI GenInfo Import identifier                             |
| **gnl**&#124;*database*&#124;*idstring*                | General (user-definable) database and identifier           |
| **gp**&#124;*coll-accession*&#124;*locus_cds#*         | GenPept (GenBank protein) identifier                       |
| **lcl**&#124;*integer*                                 | Local (user-definable) identifier                          |
| **oth**&#124;*accession*&#124;*name*&#124;*release*    | Other (user-definable) identifier*                         |
| **pat**&#124;*country*&#124;*patentid*&#124;*serialno* | Patent sequence identifier                                 |
| **pdb**&#124;*entry*&#124;*chainid*                    | Brookhaven Protein Database                                |
| **pir**&#124;*accession*&#124;*entry*                  | Protein Information Resource International                 |
| **prf**&#124;*accession*&#124;*name*                   | Protein Research Foundation                                |
| **ref**&#124;*coll-accession*&#124;*locus*             | NCBI RefSeq                                                |
| **sp**&#124;*coll-accession*&#124;*locus*              | SWISS-PROT database                                        |
| **tpd**&#124;*coll-accession*&#124;*name*              | Third party annotation&#44; DDBJ                           |
| **tpe**&#124;*coll-accession*&#124;*name*              | Third party annotation&#44; EMBL                           |
| **tpg**&#124;*coll-accession*&#124;*name*              | Third party annotation&#44; GenBank                        |

&#42;The NCBI has discontinued support for &ldquo;oth&rdquo; identifiers, but support for them is maintained in **xdformat/xdget**.
