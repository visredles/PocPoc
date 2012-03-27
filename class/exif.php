<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */

class Exif {

    function get($imagePath) {
        if ((isset($imagePath)) and (file_exists($imagePath))) {
            $exif_ifd0 = @read_exif_data($imagePath ,'IFD0' ,0);      
            $exif_exif = @read_exif_data($imagePath ,'EXIF' ,0);
            $notFound = 'N/A';

            if (@array_key_exists('Make', $exif_ifd0)) {
                $camMake = $exif_ifd0['Make'];
            } else { $camMake = $notFound; }
     
            if (@array_key_exists('Model', $exif_ifd0)) {
                $camModel = $exif_ifd0['Model'];
            } else { $camModel = $notFound; }
     
            if (@array_key_exists('ExposureTime', $exif_ifd0)) {
                $camExposure = $this->exif_get_float($exif_ifd0['ExposureTime']);
                if ($camExposure == 0) $camExposure = $notFound;
                elseif ($camExposure >= 1) $camExposure = round($camExposure) . ' s';
                else $camExposure = '1/' . round(1/$camExposure) . ' s';
            } else { $camExposure = $notFound; }

            if (@array_key_exists('ApertureFNumber', $exif_ifd0['COMPUTED'])) {
                $camAperture = $exif_ifd0['COMPUTED']['ApertureFNumber'];
            } else { $camAperture = $notFound; }
     
            if (@array_key_exists('DateTime', $exif_ifd0)) {
                $camDate = $exif_ifd0['DateTime'];
            } else { $camDate = $notFound; }
                
            if (@array_key_exists('ISOSpeedRatings',$exif_exif)) {
                $camIso = $exif_exif['ISOSpeedRatings'];
            } else { $camIso = $notFound; }

            if (@array_key_exists('FocalLength',$exif_exif)) {
                $camFocal = $this->exif_get_float($exif_exif['FocalLength']).' mm';
            } else { $camFocal = $notFound; }
     
            return array(
                'make'      => $camMake,
                'model'     => $camModel,
                'exposure'  => $camExposure,
                'aperture'  => $camAperture,
                'date'      => $camDate,
                'iso'       => $camIso,
                'focal'     => $camFocal
            );

        } else {
            return false;
        }
    }
    function exif_get_float($value) {
        $pos = strpos($value, '/');
        if ($pos === false) return (float) $value;
        $a = (float) substr($value, 0, $pos);
        $b = (float) substr($value, $pos+1);
        return ($b == 0) ? ($a) : ($a / $b);
    }
}

?>
