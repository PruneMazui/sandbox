<?php
namespace PruneMazui\Tetrice\GameCore\Tetoriminone;

use PruneMazui\Tetrice\GameCore\Field;
use PruneMazui\Tetrice\GameCore\Tile\TileBlue;

/**
 *     ■
 * ■■■   こんなやつ
 */
class LTetoriminone extends AbstractTetoriminone
{
    private $rotetion_count = 0;

    private function makeCoodinates($x, $y, $rotation_count)
    {
        if ($rotation_count % 4 == 0) {
            return [
                [$x,   $y-1],
                [$x,   $y],
                [$x-1, $y],
                [$x-2, $y],
            ];
        }

        if ($rotation_count % 4 == 1) {
            return [
                [$x+1, $y],
                [$x,   $y],
                [$x,   $y-1],
                [$x,   $y-2],
            ];
        }

        if ($rotation_count % 4 == 2) {
            return [
                [$x,   $y+1],
                [$x,   $y],
                [$x+1, $y],
                [$x+2, $y],
            ];
        }

        // $rotation_count % 4 == 3
        return [
            [$x-1, $y],
            [$x,   $y],
            [$x,   $y+1],
            [$x,   $y+2],
        ];
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\Tetrice\GameCore\Tetoriminone\AbstractTetoriminone::rotate()
     */
    protected function rotate(Field $field)
    {
        $coordinates = $this->coordinates;

        list($x, $y) = $coordinates[1]; // 基準

        $next = $this->makeCoodinates($x, $y, $this->rotetion_count + 1);

        if ($field->isCollision($next)) {
            return false;
        }

        $this->coordinates = $next;
        $this->rotetion_count++;
        return true;

    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\Tetrice\GameCore\Tetoriminone\AbstractTetoriminone::initCoordinates()
     */
    protected function getInitialCoordinates($center)
    {
        return $this->makeCoodinates($center, 0, 0);
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\Tetrice\GameCore\Tetoriminone\AbstractTetoriminone::getTile()
     */
    public function getTile()
    {
        return TileBlue::getInstance();
    }
}
