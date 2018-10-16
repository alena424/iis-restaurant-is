<?php

/*
 * @autor Alena Tesarova
 * @autor Jan Sorm 
 * FIT VUT BRNO, IIS - Informacni systemy 2018
 */

/**
 * example:
 * data[databaze_name] = 'Nazev'
 * data[databaze_name] = 'Nazev'
 */
function addFormular($data, $info = array()) {

    $expected_attr_text = array('name', 'type', 'place');
    $expected_attr_number = array('force');
    $expected_info = array('button_text');
    foreach ($data as $key => $value) {
        if (isset($data[$key])) {
            // projdeme, jestli obsahuje vsechny atributy, pokud ne doplnime defaultni hodnoty
            foreach ($expected_attr_text as $attr) {
                if (!isset($data[$key][$attr])) {
                    // neni, dame default
                    $data[$key][$attr] = "";
                }
            }

            foreach ($expected_attr_number as $attr) {
                if (!isset($data[$key][$attr])) {
                    // neni, dame default
                    $data[$key][$attr] = 0;
                }
            }
        }
    }

    foreach ($expected_info as $info_attr) {
        if (!isset($info[$info_attr])) {
            // neni, dame default
            $info[$info_attr] = "Přidat";
        }
    }
    echo "<table>";
    foreach ($data as $key => $value) {
        echo "<tr>";
        echo "<th>" . $data[$key]['name'] . ': ' . "</th>";
        $class = "my_input_form";
        $force = "";
        if ( $data[$key]['force'] ){
            $class .= " force";
        }

        echo "<th>" . '<input type=' . $data[$key]['type']. ' class=\''.$class. '\' name=' . $key . ' placeholder=' . $data[$key]['place'] . " ></th>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<button class='red_but'>" . $info['button_text'] . " </button>";
}

?>