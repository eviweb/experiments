<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * The MIT License
 *
 * Copyright 2013 Eric VILLARD <dev@eviweb.fr>.
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
 * 
 * @package     evidev\experiments\php\tests\apidesign\visitor
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */

namespace evidev\experiments\php\tests\apidesign\visitor;

use \evidev\experiments\php\apidesign\Visitor;
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\NumberImpl;
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\PlusImpl;
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\PrintVisitorVersion10;

/**
 * Visitor test suite
 * 
 * @package     evidev\experiments\php\tests\apidesign\visitor
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */
class PrintTest extends \PHPUnit_Framework_TestCase
{
    public function testPrintOnePlusOne()
    {
        $one = NumberImpl::create(1);
        $plus = PlusImpl::create($one, $one);
        //
        $print = PrintVisitorVersion10::create();
        $plus->visit(Visitor::create($print));
        
        $this->assertEquals("1 + 1", $print->toString());
    }
    
    public function testPrintOnePlusTwoPlusThree()
    {
        $one = NumberImpl::create(1);
        $two = NumberImpl::create(2);
        $three = NumberImpl::create(3);
        $plus = PlusImpl::create($one, PlusImpl::create($two, $three));
        //
        $print = PrintVisitorVersion10::create();
        $plus->visit(Visitor::create($print));
        
        $this->assertEquals("1 + 2 + 3", $print->toString());
    }
}
