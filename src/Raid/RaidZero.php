<?php
namespace kevinquinnyo\Raid\Raid;

use Cake\I18n\Number;
use kevinquinnyo\Raid\AbstractRaid;
use kevinquinnyo\Raid\Drive;

class RaidZero extends AbstractRaid
{
    const LEVEL = 0;
    protected $drives = [];
    protected $mirrored = false;
    protected $parity = false;
    protected $striped = true;
    protected $minimumDrives = 2;
    protected $drivesFailureSupported = 0;

    /**
     * Constructor.
     *
     * @param array $drives An array of \kevinquinnyo\Raid\Drive objects to initialize the RAID with.
     */
    public function __construct(array $drives = [])
    {
        if (empty($drives) === false) {
            $this->validate($drives);
        }

        $this->setDrives($drives);
    }

    /**
     * Get Capacity
     *
     * Options:
     *
     * ```
     * - human - Whether to return the results in human readable format.
     * ```
     * @param array $options Additional options to pass.
     * @return int|string Usable capacity of the RAID in bytes or human readable format.
     */
    public function getCapacity(array $options = [])
    {
        $options += [
            'human' => false,
        ];
        $capacity = $this->getTotalCapacity();

        if ($options['human'] === true) {
            return Number::toReadableSize($capacity);
        }

        return $capacity;
    }

    /**
     * Get parity total size
     *
     * Get the total size reserved for parity (unusable by data but not lossed).
     *
     * Options:
     *
     * ```
     * - human - Whether to convert the result into human readable units, e.g. - 4 TB, 500 GB, etc
     * ```
     *
     * @param array $options Additional options to scope the results.
     * @return int|string The total size reserved for parity of the RAID.
     */
    public function getParitySize(array $options = [])
    {
        $options += [
            'human' => false,
        ];
        $paritySize = 0;

        if ($options['human'] === true) {
            return Number::toReadableSize($paritySize);
        }

        return $paritySize;
    }
}
