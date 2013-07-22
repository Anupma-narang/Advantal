<?php

//require('fpdf.php');
require_once dirname(__FILE__) . '/vendor/fpdf/fpdf.php';

class PDFClass extends FPDF {

    var $B;
    var $I;
    var $U;
    var $HREF;

    function PDF($orientation = 'P', $unit = 'mm', $size = 'A4') {
        // Llama al constructor de la clase padre
        $this->FPDF($orientation, $unit, $size);
        // Iniciación de variables
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
    }

    function WriteHTML($html) {

        $html = iconv('Windows-1252', 'UTF-8', $html);
        $html = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $html);
        $html = iconv('CP1252', 'UTF-8', $html);

        // Intérprete de HTML
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                // Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                else
                    $this->Write(5, $e);
            }
            else {
                // Etiqueta
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    // Extraer atributos
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr) {
        // Etiqueta de apertura
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, true);
        if ($tag == 'A')
            $this->HREF = $attr['HREF'];
        if ($tag == 'BR')
            $this->Ln(5);

        switch ($tag) {
            case 'OL':
                $this->ol_id++;
                $this->li_id[$this->ol_id] = 0;
                $this->lMargin+=6;
                $this->Ln(5);
                break;
            case 'UL':
                $this->ol_id++;
                $this->li_id[$this->ol_id] = 0;
                $this->lMargin+=6;
                $this->Ln(5);
                break;

            case 'LI':
                if ($this->ol_id == 1)
                //     $this->SetFontSize(14);
                //    $this->SetTextColor(190, 0, 0);
                    $this->li_id[$this->ol_id]++;
                $this->Ln(2);
                if ($this->ol_id) {
                    $this->SetX($this->lMargin - 5);
                    $str = '';
                    foreach ($this->li_id as $li_id)
                        $str.= $li_id . '.';
                    $str.='  ';
                    $this->SetX($this->lMargin - 6);
                    $this->Write($this->ol_id, $str);
                    $this->SetX($this->lMargin + 6);
                    //   $this->SetX($this->lMargin);
                }

                else
                    $this->Write($this->str_w, '  * ');
                //   $this->mySetTextColor(-1);

                break;
        }
    }

    function CloseTag($tag) {
        // Etiqueta de cierre
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';

        if ($tag == 'OL') {
            unset($this->li_id[$this->ol_id]);
            $this->ol_id--;
            $this->lMargin-=6;
        }
        if ($tag == 'LI') {
            $this->Ln(4);
        }
    }

    function SetStyle($tag, $enable) {
        // Modificar estilo y escoger la fuente correspondiente
        $this->$tag += ( $enable ? 1 : -1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s) {
            if ($this->$s > 0)
                $style .= $s;
        }
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt) {
        // Escribir un hiper-enlace
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }

    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 5);
        // Número de página
        //$this->Cell(0,10,'- '.$this->PageNo().' -',0,0,'C');
        // change it for footer
        $this->Cell(0, 10, 'auditoscopia, S.L.U, con domicillio en la calle Lagasca, 95, Madrid 28006, inscrita en el registro Mercantil de Madrid, en tomo 28853,  folio 167, inscripcion 1 con hoja M-519540, con CIF: B86245909.', 0, 0, 'R');
    }

}
