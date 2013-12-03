<?php

requireAbs_once("/php/lib/sparqllib.php");

class sparqlDb {
	public function __construct() {
		//$db = sparql_connect( "http://rdf.ecs.soton.ac.uk/sparql/" );
		//
		//if( !$db ) { print $db->errno() . ": " . $db->error(). "\n"; exit; }
		//$db->ns( "foaf","http://xmlns.com/foaf/0.1/" );
		// 
		//$sparql = "SELECT * WHERE { ?person a foaf:Person . ?person foaf:name ?name . FILTER regex(?name, 'dan') } LIMIT 5";
		$db = sparql_connect( "http://palacealex.com/php/data/rdf/test.n3");
		if( !$db ) { print $db->errno() . ": " . $db->error(). "\n"; exit; }
		$sparql = "SELECT * WHERE { ?name }";
		$result = $db->query( $sparql ); 
		
		if( !$result ) { print $db->errno() . ": " . $db->error(). "\n"; exit; }
		 
		$fields = $result->field_array( $result );
		 
		print "<p>Number of rows: ".$result->num_rows( $result )." results.</p>";
		print "<table class='example_table'>";
		print "<tr>";
		
		foreach( $fields as $field )
		{
			print "<th>$field</th>";
		}
		print "</tr>";
		
		while( $row = $result->fetch_array() )
		{
			print "<tr>";
			foreach( $fields as $field )
			{
				print "<td>$row[$field]</td>";
			}
			print "</tr>";
		}
		print "</table>";
	}
}

$db = new sparqlDb();