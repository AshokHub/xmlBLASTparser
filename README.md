![xmlBLASTparser](https://raw.githubusercontent.com/AshokHub/xmlBLASTparser/master/misc/xmlBLASTparser_logo_500x125.png)

# About
[xmlBLASTparser](https://github.com/AshokHub/xmlBLASTparser) is a lightweight PHP library for parsing an XML formatted [NCBI BLAST](https://blast.ncbi.nlm.nih.gov/Blast.cgi) output and rendering into a colorful HTML page. The database accession number/id in the webpage is properly hyperlinked to the external source database. Moreover, the description summary in the webpage is hyperlinked with anchor link to the corresponding alignment section. The complete list of [NCBI](https://www.ncbi.nlm.nih.gov) standard sequence identifiers are tabulated below:

| **Tag and Identifier Syntax**                          | **Identifier Source Description**                          |
|--------------------------------------------------------|------------------------------------------------------------|
| **bbm**&#124;*integer*                                 | NCBI GenInfo Backbone database identifier                  |
| **bbs**&#124;*integer*                                 | NCBI GenInfo Backbone database identifier                  |
| **dbj**&#124;*coll-accession*&#124;*locus*             | DNA Database of Japan                                      |
| **emb**&#124;*coll-accession*&#124;*entry*             | EBI EMBL Database                                          |
| **gb**&#124;*coll-accession*&#124;*locus*              | NCBI GenBank database                                      |
| **gi**&#124;*integer*                                  | NCBI GenInfo Integrated Database ("*jee-aye*")             |
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
| **tpd**&#124;*coll-accession*&#124;*name*              | Third party annotation, DDBJ                               |
| **tpe**&#124;*coll-accession*&#124;*name*              | Third party annotation, EMBL                               |
| **tpg**&#124;*coll-accession*&#124;*name*              | Third party annotation, GenBank                            |

&#42;The NCBI has discontinued support for "oth" identifiers, but support for them is maintained in **xdformat/xdget**.

# Usage
[xmlBLASTparser](https://github.com/AshokHub/xmlBLASTparser) can be used to parse XML file format output of the [NCBI BLAST](https://blast.ncbi.nlm.nih.gov/Blast.cgi) sequence alignment result obtained through any one of the following methods:

1. [NCBI BLAST](https://blast.ncbi.nlm.nih.gov/Blast.cgi) - The XML file format output of the sequence alignment can be downloaded from the [NCBI BLAST](https://blast.ncbi.nlm.nih.gov/Blast.cgi) from the result page and loaded into the [xmlBLASTparser](https://github.com/AshokHub/xmlBLASTparser) PHP file. For example,

```php
$xml = simplexml_load_file("V07E2YXG014-Alignment.xml") or die("Error: Cannot able to create object");
```

2. [NCBI BLAST URL API](https://ncbi.github.io/blast-cloud/dev/api.html) - The XML file format content can be retrieved through PHP using NCBI BLAST URL API method. BLASTphp library is a PHP wrapper for the NCBI BLAST URL API used to stream the content of [NCBI BLAST URL API](https://ncbi.github.io/blast-cloud/dev/api.html) sequence alignment result into an XML file format. For example,

```php
$xml = file_get_contents("https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi?CMD=Get&FORMAT_TYPE=XML&RID=$rid");
```

3. [Standalone NCBI BLAST](https://blast.ncbi.nlm.nih.gov/Blast.cgi?PAGE_TYPE=BlastDocs&DOC_TYPE=Download) - The XML file format output of the sequence alignment result can be obtained by executing the standalone executable programs of NCBI BLAST and loaded into the [xmlBLASTparser](https://github.com/AshokHub/xmlBLASTparser) PHP file. For example,

```php
exec('blastp.exe -db pdb -query seq.fa -remote -outfmt 5 -out out.xml');
$xml = file_get_contents("out.xml");
```

# Support
Please feel free to sent your queries, suggestions and/or comments related to [xmlBLASTparser](https://github.com/AshokHub/xmlBLASTparser) program to [ashok.bioinformatics@gmail.com](ashok.bioinformatics@gmail.com) or [ashok@biogem.org](ashok@biogem.org).


# License
[xmlBLASTparser](https://github.com/AshokHub/xmlBLASTparser) is made available under version 3 of the GNU Lesser General Public License.
