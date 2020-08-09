<?php 
/**
* 
*/
class MtarikAbsen extends CI_Model
{
	
	function bacadataIN($tgldari,$tglsampe)
    {
        $query= "SELECT fingerprint.Nik,karyawan.nama_karyawan,dateDay,TimeDay,statusC,posted FROM `fingerprint` inner join karyawan on fingerprint.Nik=karyawan.nik where dateDay BETWEEN '".$tgldari."' AND '".$tglsampe."' AND statusC='I' ORDER BY dateDay";
        $hasil=$this->db->query($query)->row();
        return $hasil;
    }
    function filtershiftIN(){
    	$qr="SELECT nik,groupName,ShiftName,Sch_in,Sch_Out from groupshift 
			inner join workShift on groupshift.idshift = workShift.idShift";
		$hsl=$this->db->query($qr)->row();
		return $hsl;
    }
    function getAtt($tgldari){
    	$qr="select * from attendance where dateIn='".$tgldari."'and Time_in in('',null)";
		$hsl=$this->db->query($qr)->row();
		return $hsl;
    }
    function getAtt1($tgldari){
    	$qr="select * from attendance where dateIn='".$tgldari."'and Time_in is not null";
		$hsl=$this->db->query($qr)->row();
		return $hsl;
    }

// dataOUT
    function bacadataOUT($tgldari,$tglsampe)
    {
        $query= "SELECT fingerprint.Nik,karyawan.nama_karyawan,dateDay,TimeDay,statusC,posted FROM `fingerprint` inner join karyawan on fingerprint.Nik=karyawan.nik where dateDay BETWEEN '".$tgldari."' AND '".$tglsampe."' AND statusC='O' ORDER BY dateDay";
        $hasil=$this->db->query($query)->row();
        return $hasil;
    }
   
}
 ?>