<?php
namespace Subugoe\Find\ViewHelpers\Format;

/*******************************************************************************
 * Copyright notice
 *
 * Copyright 2013 Sven-S. Porst, Göttingen State and University Library
 *                <porst@sub.uni-goettingen.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 ******************************************************************************/
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * View Helper to escape a string for Solr queries.
 *
 * Usage examples are available in Private/Partials/Test.html.
 */
class SolrEscapeViewHelper extends AbstractViewHelper
{

    /**
     * Registers own arguments.
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('string', 'string', 'the string to escape for Solr', FALSE, NULL);
        $this->registerArgument('phrase', 'boolean', 'whether to use phrase escaping', FALSE, FALSE);
    }

    /**
     * @return array
     */
    public function render()
    {
        $string = $this->arguments['string'];
        if ($string === NULL) {
            $string = $this->renderChildren();
        }

        $solariumHelper = new \Solarium\Core\Query\Helper();

        if ($this->arguments['phrase']) {
            $escapedString = $solariumHelper->escapePhrase($string);
        } else {
            $escapedString = $solariumHelper->escapeTerm($string);
        }

        return $escapedString;
    }

}
