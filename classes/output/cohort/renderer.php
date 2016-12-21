<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package local_metadata
 * @author Mike Churchward <mike.churchward@poetgroup.org>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright 2016 POET
 */

/**
 * Renderer class for cohort context. Override anything needed.
 *
 * @package local_metadata
 * @copyright  2016 POET
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_metadata\output\cohort;

defined('MOODLE_INTERNAL') || die;

class renderer extends \local_metadata\output\renderer {

    /**
     * Category table renderer.
     *
     * @param category_table $categorytable renderable object.
     */
    public function render_category_table(\local_metadata\output\category_table $categorytable) {
        $output = parent::render_category_table($categorytable);
        if (get_config('local_metadata', 'cohortmetadataenabled') == 0) {
            $output = $this->notification(get_string('cohortmetadatadisabled', 'local_metadata')) . $output;
        }
        return $output;
    }

    /**
     * Cohort settings renderer.
     *
     * @param cohort_settings $cohortsettings renderable object.
     */
    public function render_manage_data(manage_data $cohortsettings) {
        global $PAGE;

        $PAGE->set_title(get_string('cohortmetadata', 'local_metadata'));
        $output = '';
        $output .= $this->header();
        $output .= $this->heading(get_string('cohortmetadata', 'local_metadata'));
        if ($cohortsettings->saved) {
            $output .= $this->notification(get_string('metadatasaved', 'local_metadata'), 'success');
        }
        $output .= $cohortsettings->form->render();
        $output .= $this->footer();

        return $output;
    }
}