<?php

namespace Petersku\ContaoSubnavigationBundle\Contao\Modules;

use Contao\BackendTemplate;
use Contao\Module;

class ModuleSubnavigation extends Module
{
    /**
     * @var string
     */
    protected $strTemplate = 'mod_subnavigation';

    /**
     * Displays a wildcard in the back end.
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $template = new \BackendTemplate('be_wildcard');

            $template->wildcard = '### '.utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['subnavigation'][0]).' ###';
            $template->title = $this->headline;
            $template->id = $this->id;
            $template->cssID = $this->cssID;
            $template->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id='.$this->id;

            return $template->parse();
        }

        return parent::generate();
    }

    /**
     * Generates the module.
     */
    protected function compile()
    {
	   $intPageID = $GLOBALS['objPage']->id; 
		
	   $items = $this->renderSubnavigation($intPageID);     
	   $this->Template->items = $items;
    }
    
    
	protected function renderSubnavigation($pid) {
		$objSubpages = \PageModel::findPublishedSubpagesWithoutGuestsByPid($pid, $this->showHidden, $this instanceof \ModuleSitemap);		
		
		/** @var \PageModel $objPage */
		global $objPage;
		//$trail = $objPage->trail;		
		
		
		if ($objSubpages === null) {
			return '';
		}
		
		$items = array();					
		
		while ($objSubpages->next()) {
			// Do not show protected pages
			if (!$objSubpages->protected || BE_USER_LOGGED_IN || (is_array($_groups) && count(array_intersect($_groups, $groups))) || $this->showProtected || ($this instanceof \ModuleSitemap && $objSubpages->sitemap == 'map_always'))
			{			
				$row = $objSubpages->row();
				//$trail = in_array($objSubpages->id, $objPage->trail);
				
				if (($objPage->id == $objSubpages->id)) {
					$row['isActive'] = true;							
				} else {
					$row['isActive'] = false;											
				}
				$row['title'] = specialchars($objSubpages->title, true);
				$row['pageTitle'] = specialchars($objSubpages->pageTitle, true);
				$row['link'] = $objSubpages->title;
				
				$href = $this->generateFrontendUrl($objSubpages->row(), null, true);
				$row['href'] = $href;
				
				$items[] = $row;
			}
		}
		
		// Add classes first and last
		if (!empty($items))
		{
			$last = count($items) - 1;
			
			$items[0]['class'] = trim($items[0]['class'] . ' first');
			$items[$last]['class'] = trim($items[$last]['class'] . ' last');
		}		
		
		return $items;
		
	}
    
}