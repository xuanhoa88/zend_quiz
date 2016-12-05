<?php

abstract class Lumia_Imex_Export extends Lumia_Imex_Abstract
{
	/**
	 * Process file data
	 */
	protected function _fileHandler()
	{
		try 
		{
			// Get number of fields
			if (count($this->_fields) === 0)
			{
				throw new Lumia_Imex_Exception(Lumia_Translator::get()->translate('ImportForm:@Invalid data row passed to CSV writer'));
			}
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator('LumiaCMS')
				 ->setLastModifiedBy('LumiaCMS')
				 ->setSubject('Bulk insert with LumiaCMS')
				 ->setDescription('Bulk insert with LumiaCMS')
				 ->setKeywords('LumiaCMS')
				 ->setCategory('Bulk insert');
			
			// Set active sheet
			$activeSheetObj = $objPHPExcel->setActiveSheetIndex(0);
			
			// Set the sheet name
			$activeSheetObj->setTitle('Bulk insert with LumiaCMS');
			
			// Stylesheet
			$style = array(
				'font' => array(
					'color' => array(
						'argb' => 'FFFFFFFF'
					),
					'bold' => true
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap' => 1
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
					)
				),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'rotation' => 90,
					'color' => array(
						'argb' => 'FFC0504D'
					)
				)
			);
			
            $letterColumn = 'A';
			foreach ($this->_fields as $fieldName => $instance)
			{
				$columnName = $letterColumn . '1';
				$activeSheetObj->setCellValueExplicit($columnName, $instance->getLabel());
				$activeSheetObj->getColumnDimension($letterColumn)->setAutoSize(true);
				$activeSheetObj->getStyle($columnName)->applyFromArray($style);
			
				$letterColumn++;
            }
			
            // Save file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save($this->_filePath);
		} catch (Exception $e)
		{
			$this->_isError = true;
			$this->_errors[] = $e->getMessage();
		}
	}
}