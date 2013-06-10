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
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\MinusImpl;
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\RealImpl;
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\PrintVisitorVersion10;
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\PrintVisitorVersion30;

/**
 * Visitor test suite
 * 
 * @package     evidev\experiments\php\tests\apidesign\visitor
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */
class PrintRealTest extends \PHPUnit_Framework_TestCase
{
    public function testPrintOneMinusTwo()
    {
        $one = RealImpl::create(1);
        $two = RealImpl::create(2);
        $minus = MinusImpl::create($one, $two);
        //
        $print = PrintVisitorVersion10::create();
        $minus->visit(Visitor::create($print));

        $this->assertEquals("unknownunknownunknown", $print->toString());
        $this->assertNotEquals("1.0 - 2.0", $print->toString());
    }
    
    public function testVisitorReadyForVersion30()
    {
        $one = NumberImpl::create(1);
        $two = NumberImpl::create(2);
        $minus = MinusImpl::create($one, $two);

        $print = PrintVisitorVersion30::create();
        $minus->visit(Visitor::create($print));

        $this->assertEquals("1.0 - 2.0", $print->toString());

        $five = RealImpl::create(5);
        $three = RealImpl::create(3);
        $realMinus = MinusImpl::create($five, $three);

        $printReal = PrintVisitorVersion30::create();
        $realMinus->visit(Visitor::create($printReal));

        $this->assertEquals("5.0 - 3.0", $printReal->toString());
    }
}
