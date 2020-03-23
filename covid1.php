<?php
//default time zone
date_default_timezone_set("Asia/Jakarta");

function covid()
{
    $array = json_decode(file_get_contents("https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/Statistik_Perkembangan_COVID19_Indonesia/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json"), true);

    $tgl = date('Y-m-d', strtotime('-1 days', strtotime(date("Y-m-d"))));
    $tgl = date('Y-m-d', strtotime(date("Y-m-d")));
    $time = "07:00:00 AM";
    $datetime = $tgl . " " . $time;
    $datetime1 = strtotime($datetime) * 1000;
    //echo $datetime1."<br>";

    $data = $array["features"];

    foreach ($data as $d) {
        $data1 = $d["attributes"]["Tanggal"];

        if ($data1 == $datetime1) {

            //echo $d["attributes"]["Tanggal"] . "<br>";
            //echo $d["attributes"]["Jumlah_Kasus_Baru_per_Hari"] . "<br>";
            //echo $d["attributes"]["Jumlah_Kasus_Kumulatif"] . "<br>";
            //echo $d["attributes"]["Jumlah_pasien_dalam_perawatan"] . "<br>";
            //echo $d["attributes"]["Persentase_Pasien_dalam_Perawatan"] . "<br>";
            //echo $d["attributes"]["Jumlah_Pasien_Sembuh"] . "<br>";
            //echo $d["attributes"]["Persentase_Pasien_Sembuh"] . "<br>";
            //echo $d["attributes"]["Jumlah_Pasien_Meninggal"] . "<br>";
            //echo $d["attributes"]["Persentase_Pasien_Meninggal"] . "<br>";

            echo "<table cellpadding='10' width='100%' align='center'>";
            echo "<tr>";
            echo "<td style='background-color:red; color:white;' align='center'><h6>POSITIF</h6>" . $d["attributes"]["Jumlah_Kasus_Kumulatif"] . " Org</td>";
            echo "<td style='background-color:green; color:white;' align='center'><h6>SEMBUH</h6>" . $d["attributes"]["Jumlah_Pasien_Sembuh"] . " Org</td>";
            echo "<td style='background-color:black; color:white;' align='center'><h6>MENINGGAL</h6>" . $d["attributes"]["Jumlah_Pasien_Meninggal"] . " Org</td>";
            echo "</tr>";
            echo "</table>";
        }
    }
}

covid();
?>