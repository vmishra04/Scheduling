<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Alldata Model
 *
 * @package Models
 */
class Alldata_Model extends CI_Model {
    /**
     * Add an appointment record to the database.
     *
     * This method adds a new appointment to the database. If the appointment doesn't exists it is going to be inserted,
     * otherwise the record is going to be updated.
     *
     * @param array $appointment Associative array with the appointment data. Each key has the same name with the
     * database fields.
     *
     * @return int Returns the appointments id.
     */
    public function add($alldata)
    {
        
        // Perform insert() or update() operation.
        if ( ! isset($alldata['id']))
        {
            $alldata['id'] = $this->_insert($alldata);
        }
        else
        {
            $this->_update($alldata);
        }

        return $alldata['id'];
    }


    /**
     * Insert a new appointment record to the database.
     *
     * @param array $appointment Associative array with the appointment's data. Each key has the same name with the
     * database fields.
     *
     * @return int Returns the id of the new record.
     *
     * @throws Exception If appointment record could not be inserted.
     */
    protected function _insert($alldata)
    {
        
        if ( ! $this->db->insert('all_data', $alldata))
        {
            throw new Exception('Could not insert All data record.');
        }

        return (int)$this->db->insert_id();
    }

    /**
     * Update an existing appointment record in the database.
     *
     * The appointment data argument should already include the record ID in order to process the update operation.
     *
     * @param array $appointment Associative array with the appointment's data. Each key has the same name with the
     * database fields.
     *
     * @throws Exception If appointment record could not be updated.
     */
    protected function _update($alldata)
    {
        $this->db->where('id', $alldata['id']);
        if ( ! $this->db->update('all_data', $alldata))
        {
            throw new Exception('Could not update appointment record.');
        }
    }

}
