<?php

// Funkcija koja prima string
function znakovi($rijec){
  // Koliko znakova ima taj string
  $counter = strlen($rijec);
  $samoglasnici = 0;

  // Prodi kroz svako slovo od stringa
  for($i=0; $i < $counter; $i++) {
      // Provjeri svako slovo
      if(($rijec[$i]=='a')||($rijec[$i]=='e')||($rijec[$i]=='i')||($rijec[$i]=='o')||($rijec[$i]=='u')){  
          $samoglasnici++;
      }
  }
  return $samoglasnici;
}

// Funkcija koja provjerava suglasnike
function isConstant($word) {
  // Za lowercase
  $word = strtoupper($word);

  return !($word == 'A' or $word == 'E' or $word == 'I' or $word == 'O' or $word == 'U') && ord($word) >= 65 && ord($word) <= 90;
}

// Funkcija koja vraca broj suglasnika
function totalConstants($word) {
  $count = 0;
  for($i = 0; $i < strlen($word); $i++)

  // Projevera koliko suglasnika ima
  if (isConstant($word[$i])) {
    $count ++;
  }
  return $count;
}


function slova($rijec) {
  $slova = 0;
  $duljinaStringa = strlen($rijec);

  for ($i = 0; $i < $duljinaStringa; $i++) {

      if (!is_numeric($rijec[$i])) {
          $slova++;
      }
  }
      return $slova;
}


// Citanje sadrzaja iz datoteke
$rijeciJson = file_get_contents(__DIR__.'/rijeci.json');
// Prebacivanje u niz
$rijeci = json_decode($rijeciJson, true);

// Stavljanje $_POST rezultat u varijablu
$rijec = $_POST['tekst'];

$suglasnici = totalConstants($rijec);
$broj_slova = slova($rijec);
$samoglasnici = znakovi($rijec);

// Provjera da li je $_POST prazan
if ($_POST['tekst'] == null) {
  echo 'Field is empty';
} elseif ($_POST['tekst'] == !null){
  $rijeci[] = [
    'rijec' => $rijec,
    'broj slova' => $broj_slova,
    'broj suglasnika' => $suglasnici,
    'broj samoglasnika' => $samoglasnici
  ];
}

// Transformiranje u JSON
$rijeciJson = json_encode($rijeci);
// Zapisivanje novih podataka u JSON datoteku
file_put_contents(__DIR__.'/rijeci.json', $rijeciJson);

?>

<form method = 'POST'>
  <label>Upisite rijec:</label>
  <br />
  <input type = 'text' name = 'tekst' />
  <input type = 'submit' value = 'Posalji' />
</form>

<table border='1' cellpadding = '10'>
  <tr>
    <th>Rijec</th>
    <th>Broj slova</th>
    <th>Broj suglasnika</th>
    <th>Broj samoglasnika</th>
  </tr>
  <?php
    foreach($rijeci as $rijec) {
      echo '<tr>';
      echo '<td>' . $rijec['rijec'] . '</td>';
      echo '<td>' . $rijec['broj slova'] . '</td>';
      echo '<td>' . $rijec['broj suglasnika'] . '</td>';
      echo '<td>' . $rijec['broj samoglasnika'] . '</td>';
      echo '</tr>';
    }
  ?>
</table>
