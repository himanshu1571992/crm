<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends TCPDF
{
    /**
     * Stores font list
     * @var array
     */
    public $_fonts_list = [];

    /**
     * This is true when last page is rendered
     * @var boolean
     */
    protected $last_page_flag = false;

    /**
     * PDF Type
     * invoice,estimate,proposal,contract
     * @var string
     */
    private $pdf_type = '';

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false, $pdf_type = '')
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);

        $this->pdf_type       = $pdf_type;
        $lg                   = [];
        $lg['a_meta_charset'] = 'UTF-8';

        $this->setLanguageArray($lg);
        $this->_fonts_list = $this->fontlist;

        do_action('pdf_construct', ['pdf_instance' => $this, 'type' => $this->pdf_type]);
    }

    public function Close()
    {
        include_once(APPPATH . 'libraries/PDF_Signature.php');
        $signature = new PDF_Signature($this, $this->pdf_type);
        $signature->process();

        do_action('pdf_close', ['pdf_instance' => $this, 'type' => $this->pdf_type]);

        $this->last_page_flag = true;
        parent::Close();
    }

    public function Header()
    {
        do_action('pdf_header', ['pdf_instance' => $this, 'type' => $this->pdf_type]);
    }

    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);

        $font_name = get_option('pdf_font');
        $font_size = get_option('pdf_font_size');

        if ($font_size == '') {
            $font_size = 10;
        }

        $this->SetFont($font_name, '', $font_size);

        do_action('pdf_footer', ['pdf_instance' => $this, 'type' => $this->pdf_type]);
$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        if (get_option('show_page_number_on_pdf') == 1) {
            $this->SetFont($font_name, 'I', 8);
            $this->SetTextColor(142, 142, 142);
            $this->Cell(0, 15, $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    public function get_fonts_list()
    {
        return $this->_fonts_list;
    }
}
