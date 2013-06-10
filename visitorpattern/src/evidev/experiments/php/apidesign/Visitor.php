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
 * @package     evidev\experiments\php\apidesign
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */

namespace evidev\experiments\php\apidesign;

use \evidev\experiments\php\apidesign\visitor\VisitorBasis;
use \evidev\experiments\php\apidesign\visitor\Version10;
use \evidev\experiments\php\apidesign\visitor\Version20;
use \evidev\experiments\php\apidesign\visitor\Version30;
use \evidev\experiments\php\apidesign\visitor\internal\VisitorVersion10;
use \evidev\experiments\php\apidesign\visitor\internal\VisitorVersion20;
use \evidev\experiments\php\apidesign\visitor\internal\VisitorVersion30;
use \evidev\experiments\php\apidesign\expression\Number;
use \evidev\experiments\php\apidesign\expression\Plus;
use \evidev\experiments\php\apidesign\expression\Minus;
use \evidev\experiments\php\apidesign\expression\Real;

/**
 * visitor abstract class
 * 
 * @package     evidev\experiments\php\apidesign
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */
abstract class Visitor
{
    /**
     * visitor implementation
     * 
     * @var VisitorBasis
     */
    protected $impl;
    
    /**
     * constructor
     * 
     * @param \evidev\experiments\php\apidesign\visitor\VisitorBasis $provider  visitor implementation provider
     */
    protected function __construct(VisitorBasis $provider)
    {
        $this->impl = $provider;
    }
    
    /**
     * factory method
     * 
     * create a visitor instance depending on the implemented client interface 
     * and delegate visit processing to the implementation provider
     * 
     * @param object $provider  visitor implementation provider
     * @return \evidev\experiments\php\apidesign\Visitor    returns the Visitor instance or null
     */
    final public static function create($provider)
    {
        $interfaces = class_implements($provider, false);
        unset($interfaces['evidev\experiments\php\apidesign\visitor\VisitorBasis']);
        $interface = (string)array_pop($interfaces);
        $method = 'create'.substr($interface, strrpos($interface, '\\')+1);
        if (is_callable('static::'.$method)) {
            return static::$method($provider);
        }
        return null;
    }
    
    /**
     * factory method
     * 
     * @param \evidev\experiments\php\apidesign\visitor\Version10 $provider v1.0 implementation provider
     * @return \evidev\experiments\php\apidesign\visitor\internal\VisitorVersion10  returns the Visitor instance
     * @since 1.0
     */
    final protected static function createVersion10(Version10 $provider)
    {
        return new VisitorVersion10($provider);
    }

    /**
     * factory method
     *
     * @param \evidev\experiments\php\apidesign\visitor\Version20 $provider v2.0 implementation provider
     * @return \evidev\experiments\php\apidesign\visitor\internal\VisitorVersion20  returns the Visitor instance
     * @since 2.0
     */
    final protected static function createVersion20(Version20 $provider)
    {
        return new VisitorVersion20($provider);
    }

    /**
     * factory method
     *
     * @param \evidev\experiments\php\apidesign\visitor\Version30 $provider v3.0 implementation provider
     * @return \evidev\experiments\php\apidesign\visitor\internal\VisitorVersion30  returns the Visitor instance
     * @since 3.0
     */
    final protected static function createVersion30(Version30 $provider)
    {
        return new VisitorVersion30($provider);
    }
    
    /**
     * dispatch visit processing of a Number expression
     * 
     * @uses overrideableDispatchNumber
     * @param \evidev\experiments\php\apidesign\expression\Number $number
     * @since 1.0
     */
    final public function dispatchNumber(Number $number)
    {
        $this->overrideableDispatchNumber($number);
    }
    
    /**
     * dispatchNumber implementation
     * 
     * @usedby dispatchNumber
     * @param \evidev\experiments\php\apidesign\expression\Number $number
     * @since 1.0
     */
    abstract protected function overrideableDispatchNumber(Number $number);
    
    /**
     * dispatch visit processing of a Plus expression
     * 
     * @uses overrideableDispatchPlus
     * @param \evidev\experiments\php\apidesign\expression\Plus $sum
     * @since 1.0
     */
    final public function dispatchPlus(Plus $sum)
    {
        $this->overrideableDispatchPlus($sum);
    }
    
    /**
     * dispatchPlus implementation
     * 
     * @usedby dispatchPlus
     * @param \evidev\experiments\php\apidesign\expression\Plus $sum
     * @since 1.0
     */
    abstract protected function overrideableDispatchPlus(Plus $sum);

    /**
     * dispatch visit processing of a Minus expression
     *
     * @uses overrideableDispatchMinus
     * @param \evidev\experiments\php\apidesign\expression\Minus $minus
     * @since 2.0
     */
    final public function dispatchMinus(Minus $minus)
    {
        $this->overrideableDispatchMinus($minus);
    }

    /**
     * dispatchMinus implementation
     *
     * @usedby dispatchMinus
     * @param \evidev\experiments\php\apidesign\expression\Minus $minus
     * @since 2.0
     */
    abstract protected function overrideableDispatchMinus(Minus $minus);

    /**
     * dispatch visit processing of a Real expression
     *
     * @uses overrideableDispatchReal
     * @param \evidev\experiments\php\apidesign\expression\Real $real
     * @since 3.0
     */
    final public function dispatchReal(Real $real)
    {
        $this->overrideableDispatchReal($real);
    }

    /**
     * dispatchReal implementation
     *
     * @usedby dispatchReal
     * @param \evidev\experiments\php\apidesign\expression\Real $real
     * @since 3.0
     */
    abstract protected function overrideableDispatchReal(Real $real);
}
