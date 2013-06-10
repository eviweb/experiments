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
 * @package     evidev\experiments\php\tests\apidesign\visitor\fixtures
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */

namespace evidev\experiments\php\tests\apidesign\visitor\fixtures;

use \evidev\experiments\php\apidesign\Visitor;
use \evidev\experiments\php\apidesign\visitor\Version30;
use \evidev\experiments\php\apidesign\Expression;
use \evidev\experiments\php\apidesign\expression\Number;
use \evidev\experiments\php\apidesign\expression\Plus;
use \evidev\experiments\php\apidesign\expression\Minus;
use \evidev\experiments\php\apidesign\expression\Real;
use \evidev\experiments\php\tests\apidesign\visitor\fixtures\AbstractPrinter;

/**
 * visitor implementation for printing
 * 
 * @package     evidev\experiments\php\tests\apidesign\visitor\fixtures
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */
final class PrintVisitorVersion30 extends AbstractPrinter implements Version30
{
    /**
     * @inheritdoc
     */
    public function visitPlus(Plus $sum, Visitor $self)
    {
        $sum->getFirst()->visit($self);
        $this->append(" + ");
        $sum->getSecond()->visit($self);
    }

    /**
     * @inheritdoc
     */
    public function visitUnknown(Expression $expression, Visitor $self)
    {
        $this->append('unknown');
        return true;
    }

    /**
     * @inheritdoc
     */
    public function visitMinus(Minus $minus, Visitor $self)
    {
        $minus->getFirst()->visit($self);
        $this->append(" - ");
        $minus->getSecond()->visit($self);
    }

    /**
     * @inheritdoc
     */
    public function visitReal(Real $real, Visitor $self)
    {
        $this->append(number_format($real->getValue(), 1));
    }
}
