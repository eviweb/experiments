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
 * @package     evidev\experiments\php\apidesign\visitor\internal
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */

namespace evidev\experiments\php\apidesign\visitor\internal;

use \evidev\experiments\php\apidesign\Visitor;
use \evidev\experiments\php\apidesign\visitor\Version10;
use \evidev\experiments\php\apidesign\expression\Number;
use \evidev\experiments\php\apidesign\expression\Plus;
use \evidev\experiments\php\apidesign\expression\Minus;
use \evidev\experiments\php\apidesign\expression\Real;

/**
 * visitor API 1.0
 * 
 * @package     evidev\experiments\php\apidesign\visitor\internal
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 * @version     1.0
 */
final class VisitorVersion10 extends Visitor
{
    /**
     * visitor implementation
     *
     * @var \evidev\experiments\php\apidesign\visitor\Version10
     */
    protected $impl;

    /**
     * constructor
     *
     * @param \evidev\experiments\php\apidesign\visitor\Version10 $provider  visitor implementation provider
     */
    protected function __construct(Version10 $provider)
    {
        $this->impl = $provider;
    }

    /**
     * @inheritdoc
     */
    protected function overrideableDispatchNumber(Number $number)
    {
        $this->impl->visitNumber($number, $this);
    }

    /**
     * @inheritdoc
     */
    protected function overrideableDispatchPlus(Plus $sum)
    {
        $this->impl->visitPlus($sum, $this);
    }

    /**
     * @inheritdoc
     */
    protected function overrideableDispatchMinus(Minus $minus)
    {
        if ($this->impl->visitUnknown($minus, $this)) {
            $minus->getFirst()->visit($this);
            $minus->getSecond()->visit($this);
        }
    }

    /**
     * @inheritdoc
     */
    protected function overrideableDispatchReal(Real $real)
    {
        $this->impl->visitUnknown($real, $this);
    }
}
