<?php
namespace kevinquinnyo\Raid\Raid;

use kevinquinnyo\Raid\AbstractRaid;
use kevinquinnyo\Raid\Drive;

class RaidFive extends AbstractRaid
{
    protected $drives = [];
    protected $minimumDrives = 3;
    protected $mirrored = false;
    protected $parity = true;
    protected $striped = true;

    public function __construct($drives = [])
    {
        if (empty($drives) === false) {
            $this->validate($drives);
        }

        $this->drives = $drives;
    }

    public function getCapacity()
    {
        $total = $this->getTotalCapacity();
        $min = $this->getMinimumDriveSize();

        return $total === 0 ? $total : ($total - $min);
    }
}
