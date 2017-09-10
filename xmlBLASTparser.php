<!DOCTYPE html>
<html>
<head>
	<title>xmlBLASTparser&colon; a lightweight PHP library for parsing BLAST XML</title>
	<style type= "text/css">
	table#definition, table#iteration, table#hlist, table#hits, table#statistics { border-collapse: collapse; align: center; }
	table#definition { width: 500px; }
	table#definition td { border: 1px solid ForestGreen; padding: 2px; }
	table#definition td:nth-child(odd) { color: white; background: Green; }
	table#iteration, table#hlist, table#hits { width: 700px; }
	table#iteration th { color: white; background: OrangeRed; border: 1px solid Red; padding: 2px; }
	table#iteration td { border: 1px solid Red; padding: 2px; }
	table#iteration tr:nth-child(odd) { background: PapayaWhip; }
	table#hlist th { color: White; background: Orange; border: 1px solid Orange; padding: 2px; }
	table#hlist td { border: 1px solid DarkOrange; padding: 2px; }
	table#hlist tr:nth-child(odd) { background: Cornsilk; }
	table#hits th { color: White; background: GoldenRod; border: 1px solid GoldenRod; padding: 2px; }
	table#hits td { border: 1px solid GoldenRod; padding: 2px; }
	table#hits tr:nth-child(odd) { background: LightGoldenRodYellow; }
	table#statistics { width: 300px; }
	table#statistics td { border: 1px solid Coral; padding: 2px; }
	table#statistics td:nth-child(odd) { color: white; background: Chocolate; }
	#ops { padding: 0.1px 0 0.1px 0; font-family: "Lucida Console", Monaco, monospace; -ms-word-break: break-all; word-break: break-all; word-break: break-word; }
	#ilnk { text-decoration: none; }
	#blout { font-family: monospace; }
	#algfmt { line-height: 130%; }
	</style>
</head>
<body>
<div id="blout">
<?php
$xml = simplexml_load_file("V07E2YXG014-Alignment.xml") or die("Error: Cannot able to create object");
function def_split($x, $y) {
	$a = "&gt;" . $x . " " . $y;
	$a = preg_replace("/\>/", "&gt;", $a);
	$a = preg_replace("/ \&gt\;/", "<br/>&gt;", $a);
	return $a;
}
function def_trim($def) {
	$defn = preg_replace("/ \&gt\;/", ">", $def);
	$defn = explode('>', $defn);
	if (strlen($defn[0]) > 65) return substr($defn[0], 0, 63) . "...";
	else return $defn[0];
}
function fmtprint($length, $query_seq, $query_seq_from, $query_seq_to, $align_seq, $sbjct_seq, $sbjct_seq_from, $sbjct_seq_to) {
	$n = (int)($length / 60);
	$r = $length % 60;
	if ($r > 0) $t = $n + 1;
	else $t = $n;
	$j = 0;
	$xn = $query_seq_from;
	$an = $sbjct_seq_from;
	for ($i = 0; $i < $t; $i++) {
		$xs = substr($query_seq, 60*$i, 60);
		$xs = preg_replace("/-/", "", $xs);
		$yn = $xn + strlen($xs) - 1;
		printf("\nQuery  %-4d %s  %d", $xn, substr($query_seq, 60*$i, 60), $yn);
		$xn = $yn + 1;
		printf("\n            %s", substr($align_seq, 60*$i, 60));
		$ys = substr($sbjct_seq, 60*$i, 60);
		$ys = preg_replace("/-/", "", $ys);
		$bn = $an + strlen($ys) - 1;
		printf("\nSbjct  %-4d %s  %d\n", $an, substr($sbjct_seq, 60*$i, 60), $bn);
		$an = $bn + 1;
	}
}
function annotate($def) {
	$pn = preg_match_all('/\|pdb\|\K[^\|]*(?=\|)/', $def, $m);
	if ($pn > 0) {
		for ($i1 = 0; $i1 < $pn; $i1++) {
			$id[$i1] = $m[0][$i1];
		}
		$id = array_unique($id);
		$id = array_filter($id);
		$id = array_values($id);
		if (!empty($id)) {
			$n = count($id);
			for ($i1 = 0; $i1 < $n; $i1++) {
				$def = preg_replace("/$id[$i1]/", "<a href=\"http://www.rcsb.org/pdb/explore/explore.do?structureId=$id[$i1]\" id='ilnk' target='_blank'>". $id[$i1] . "</a>", $def);
			}
		}
	}
	$gn = preg_match_all('/gi\|\K[^\|]*(?=\|)/', $def, $m1);
	if ($gn > 0) {
		for ($i2 = 0; $i2 < $gn; $i2++) {
			$gid[$i2] = $m1[0][$i2];
		}
		$gid = array_unique($gid);
		$gid = array_filter($gid);
		$gid = array_values($gid);
		if (!empty($gid)) {
			$n1 = count($gid);
			for ($i2 = 0; $i2 < $n1; $i2++) {
				$def = preg_replace("/$gid[$i2]/", "<a href=\"https://www.ncbi.nlm.nih.gov/protein/$gid[$i2]\" id='ilnk' target='_blank'>". $gid[$i2] . "</a>", $def);
			}
		}
	}
	$gb = preg_match_all('/gb\|\K[^\|]*(?=\|)/', $def, $m2);
	if ($gb > 0) {
		for ($i3 = 0; $i3 < $gb; $i3++) {
			$gbid[$i3] = $m2[0][$i3];
		}
		$gbid = array_unique($gbid);
		$gbid = array_filter($gbid);
		$gbid = array_values($gbid);
		if (!empty($gbid)) {
			$n2 = count($gbid);
			for ($i3 = 0; $i3 < $n2; $i3++) {
				$def = preg_replace("/$gbid[$i3]/", "<a href=\"https://www.ncbi.nlm.nih.gov/nucleotide/$gbid[$i3]\" id='ilnk' target='_blank'>". $gbid[$i3] . "</a>", $def);
			}
		}
	}
	$rf = preg_match_all('/ref\|\K[^\|]*(?=\|)/', $def, $m3);
	if ($rf > 0) {
		for ($i4 = 0; $i4 < $rf; $i4++) {
			$rfid[$i4] = $m3[0][$i4];
		}
		$rfid = array_unique($rfid);
		$rfid = array_filter($rfid);
		$rfid = array_values($rfid);
		if (!empty($rfid)) {
			$n3 = count($rfid);
			for ($i4 = 0; $i4 < $n3; $i4++) {
				$def = preg_replace("/$rfid[$i4]/", "<a href=\"https://www.ncbi.nlm.nih.gov/nuccore/$rfid[$i4]\" id='ilnk' target='_blank'>". $rfid[$i4] . "</a>", $def);
			}
		}
	}
	$sp = preg_match_all('/sp\|\K[^\|]*(?=\|)/', $def, $m4);
	if ($sp > 0) {
		for ($i5 = 0; $i5 < $sp; $i5++) {
			$spid[$i5] = $m4[0][$i5];
		}
		$spid = array_unique($spid);
		$spid = array_filter($spid);
		$spid = array_values($spid);
		if (!empty($spid)) {
			$n4 = count($spid);
			for ($i5 = 0; $i5 < $n4; $i5++) {
				$def = preg_replace("/$spid[$i5]/", "<a href=\"http://www.uniprot.org/uniprot/" . array_shift(explode('.', $spid[$i5])) . "\" id='ilnk' target='_blank'>". $spid[$i5] . "</a>", $def);
			}
		}
	}
	return $def;
}
?>
<p id="ops">
<table id="definition" align="center">
	<tbody>
		<tr><td>Program</td><td><?php print $xml->BlastOutput_program; ?></td></tr>
		<tr><td>Version</td><td><?php print $xml->BlastOutput_version; ?></td></tr>
		<tr><td>Reference</td><td><?php print $xml->BlastOutput_reference; ?></td></tr>
		<tr><td>Database</td><td><?php print $xml->BlastOutput_db; ?></td></tr>
		<tr><td>Query ID</td><td><?php print $xml->{'BlastOutput_query-ID'}; ?></td></tr>
		<tr><td>Definition</td><td><?php print $xml->{'BlastOutput_query-def'}; ?></td></tr>
		<tr><td>Length</td><td><?php print $xml->{'BlastOutput_query-len'}; ?></td></tr>
		<tr><td>Matrix</td><td><?php print $xml->BlastOutput_param->Parameters->Parameters_matrix; ?></td></tr>
		<tr><td>E-value</td><td><?php print $xml->BlastOutput_param->Parameters->Parameters_expect; ?></td></tr>
		<tr><td>Gap Open</td><td><?php print $xml->BlastOutput_param->Parameters->{'Parameters_gap-open'}; ?></td></tr>
		<tr><td>Gap Extend</td><td><?php print $xml->BlastOutput_param->Parameters->{'Parameters_gap-extend'}; ?></td></tr>
		<tr><td>Filter</td><td><?php print $xml->BlastOutput_param->Parameters->Parameters_filter; ?></td></tr>
	</tbody>
</table>
</p>

<?php
foreach($xml->BlastOutput_iterations->Iteration as $itr) {
	$Iteration_iter_num = $itr->{'Iteration_iter-num'};
	$Iteration_query_ID = $itr->{'Iteration_query-ID'};
	$Iteration_query_def = $itr->{'Iteration_query-def'};
	$Iteration_query_len = $itr->{'Iteration_query-len'};
	?>
	<p id="ops">
	<table id="iteration" align="center">
		<tbody>
			<tr><th>Iteration Number: <?php print $Iteration_iter_num; ?></th></tr>
			<tr><td>Query ID: <?php print $Iteration_query_ID; ?></td></tr>
			<tr><td>Definition: <?php print $Iteration_query_def; ?></td></tr>
			<tr><td>Length: <?php print $Iteration_query_len; ?></td></tr>
		</tbody>
	</table>
	</p>
	<p id="ops">
	<table id="hlist" align="center">
		<tbody>
			<tr>
				<th colspan="2">Sequences producing significant alignments</th>
				<th>Score<br/>(Bits)</th>
				<th>E<br/>Value</th>
			</tr>
	<?php
	foreach($itr->Iteration_hits->Hit as $lst) {
		$Hit_def = $lst->Hit_def;
		$Hit_accession = $lst->Hit_accession;
		$Hsp_bit_score = $lst->Hit_hsps->Hsp->{'Hsp_bit-score'};
		$Hsp_evalue = $lst->Hit_hsps->Hsp->Hsp_evalue;
		?>
			<tr>
				<td align="center"><?php print "<a href='#" . $Hit_accession . "' id='ilnk'>" . $Hit_accession . "</a>"; ?></td>
				<td><?php print def_trim($Hit_def); ?></td>
				<td align="center"><?php print (int)$Hsp_bit_score; ?></td>
				<td align="center"><?php printf("%.1f", $Hsp_evalue); ?></td>
			</tr>
	<?php
	}
	?>
		</tbody>
	</table>
	</p>
	<?php
	foreach($itr->Iteration_hits->Hit as $algn) {
		$Hit_num = $algn->Hit_num;
		$Hit_id = $algn->Hit_id;
		$Hit_def = $algn->Hit_def;
		$Hit_accession = $algn->Hit_accession;
		$Hit_len = $algn->Hit_len;
		$Hsp_num = $algn->Hit_hsps->Hsp->Hsp_num;
		$Hsp_bit_score = $algn->Hit_hsps->Hsp->{'Hsp_bit-score'};
		$Hsp_score = $algn->Hit_hsps->Hsp->Hsp_score;
		$Hsp_evalue = $algn->Hit_hsps->Hsp->Hsp_evalue;
		$Hsp_query_from = $algn->Hit_hsps->Hsp->{'Hsp_query-from'};
		$Hsp_query_to = $algn->Hit_hsps->Hsp->{'Hsp_query-to'};
		$Hsp_hit_from = $algn->Hit_hsps->Hsp->{'Hsp_hit-from'};
		$Hsp_hit_to = $algn->Hit_hsps->Hsp->{'Hsp_hit-to'};
		$Hsp_query_frame = $algn->Hit_hsps->Hsp->{'Hsp_query-frame'};
		$Hsp_hit_frame = $algn->Hit_hsps->Hsp->{'Hsp_hit-frame'};
		$Hsp_identity = $algn->Hit_hsps->Hsp->{'Hsp_identity'};
		$Hsp_positive = $algn->Hit_hsps->Hsp->{'Hsp_positive'};
		$Hsp_gaps = $algn->Hit_hsps->Hsp->{'Hsp_gaps'};
		$Hsp_align_len = $algn->Hit_hsps->Hsp->{'Hsp_align-len'};
		$Hsp_qseq = $algn->Hit_hsps->Hsp->{'Hsp_qseq'};
		$Hsp_midline = $algn->Hit_hsps->Hsp->{'Hsp_midline'};
		$Hsp_hseq = $algn->Hit_hsps->Hsp->{'Hsp_hseq'};
		?>
		<p id="ops">
		<table id="hits" align="center">
			<tbody>
				<tr><th><?php print "Hit Number: " . $Hit_num . ", Accession Number: <span id='" . $Hit_accession . "'>" . $Hit_accession; ?></span></th></tr>
				<tr><td><?php $sdef = def_split($Hit_id, $Hit_def); print annotate($sdef); ?></td></tr>
				<tr><td><?php print "Length = ". $Hit_len . ", Score =  " . (int)$Hsp_bit_score . " bits (" . $Hsp_score . "), Expect = " . $Hsp_evalue . ",<br>Identities = " . $Hsp_identity . "/" . $Hsp_align_len . " (" . (int)(($Hsp_identity/$Hsp_align_len)*100) . "%), Positives = " . $Hsp_positive . "/" . $Hsp_align_len . " (" . (int)(($Hsp_positive/$Hsp_align_len)*100) . "%), Gaps = ". $Hsp_gaps . "/" . $Hsp_align_len . " (" . (int)(($Hsp_gaps/$Hsp_align_len)*100) . "%)"; ?></td></tr>
				<tr><td><pre id="algfmt"><?php fmtprint($Hsp_align_len, $Hsp_qseq, $Hsp_query_from, $Hsp_query_to, $Hsp_midline, $Hsp_hseq, $Hsp_hit_from, $Hsp_hit_to); ?></pre></td></tr>
			</tbody>
		</table>
		</p>
	<?php 
	}
	?>		
	<p id="ops">
	<table id="statistics" align="center">
		<tbody>
			<tr><td>Number of Sequences</td><td><?php print $itr->Iteration_stat->Statistics->{'Statistics_db-num'}; ?></td></tr>
			<tr><td>Length of database</td><td><?php print $itr->Iteration_stat->Statistics->{'Statistics_db-len'}; ?></td></tr>
			<tr><td>Length adjustment</td><td><?php print $itr->Iteration_stat->Statistics->{'Statistics_hsp-len'}; ?></td></tr>
			<tr><td>Effective search space</td><td><?php print $itr->Iteration_stat->Statistics->{'Statistics_eff-space'}; ?></td></tr>
			<tr><td>Kappa (&kappa;)</td><td><?php print $itr->Iteration_stat->Statistics->{'Statistics_kappa'}; ?></td></tr>
			<tr><td>Lambda (&lambda;)</td><td><?php print $itr->Iteration_stat->Statistics->{'Statistics_lambda'}; ?></td></tr>
			<tr><td>Entropy (H)</td><td><?php print $itr->Iteration_stat->Statistics->{'Statistics_entropy'}; ?></td></tr>
		</tbody>
	</table>
	</p>
<?php
}
?>
</div>
</body>
</html>
