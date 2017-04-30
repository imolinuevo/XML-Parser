<?php

class XMLParserController {

  var $csvFileName = "tours.csv";
  var $headers = ["Title", "Code", "Duration", "Inclusions", "MinPrice"];

  function xmlToCSV($inputFileContent) {
    $xml = new SimpleXMLElement($inputFileContent);
    $this->createCSV($xml);
    $this->downloadCSV();
  }

  private function createCSV($xml) {
    $csv = fopen($this->csvFileName, 'w');
    $headers = array();
    $headers = $this->headers;
    fputcsv($csv, $headers, ',', '"');
    foreach($xml as $entry) {
      $data = get_object_vars($entry);
      $sanitized_data = array();
      $sanitized_data['Title'] = strip_tags(html_entity_decode(trim($entry->Title), ENT_COMPAT, 'UTF-8'));
      $sanitized_data['Code'] = strip_tags(html_entity_decode(trim($entry->Code), ENT_COMPAT, 'UTF-8'));
      $sanitized_data['Duration'] = strip_tags(html_entity_decode(trim($entry->Duration), ENT_COMPAT, 'UTF-8'));
      $sanitized_data['Inclusions'] = strip_tags(html_entity_decode(trim($entry->Inclusions), ENT_COMPAT, 'UTF-8'));
      $sanitized_data['MinPrice'] = $this->getTourMinPrice($entry);
      fputcsv($csv, $sanitized_data, ',', '"');
    }
    fclose($csv);
  }

  private function getTourMinPrice($tour) {
    $minPrice = $this->getDeparturePrice($tour->DEP[0]);
    foreach($tour->DEP as $departure) {
      $newPrice = $this->getDeparturePrice($departure);
      if($minPrice > $newPrice) {
        $minPrice = $newPrice;
      }
    }
    return $minPrice;
  }

  private function getDeparturePrice($departure) {
    if($departure['DISCOUNT']) {
      $price = number_format((float)$departure['EUR'], 2, '.', '');
      $discount = str_replace('%', '', $departure['DISCOUNT']) / 100;
      return number_format((float)$price - ($price * $discount), 2, '.', '');
    } else {
      return number_format((float)$departure['EUR'], 2, '.', '');
    }
  }

  private function downloadCSV() {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($this->csvFileName).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($this->csvFileName));
    readfile($this->csvFileName);
    exit;
  }
}

?>
