<?php

namespace Database\Seeders;

use App\Enum\DeputyMinistryEnum;
use App\Enum\DirectorateTypeEnum;
use App\Models\Directorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


$directorates = [
    // ['name' => 'Financial and administrative assistant', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'Policy and Planning Department', 'directorate_id' => DeputyMinistryEnum::PlanAndPolicy->value],
    // ['name' => 'Head of the office', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Department of Health Economics and Financing', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'Directorate of Legislation and Strategy', 'directorate_id' => DeputyMinistryEnum::PlanAndPolicy->value],
    // ['name' => 'Directorate of Specialized and Tertiary Hospitals', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Procurement and Logistics Department', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'Department of Diagnostic Services', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'General Department of Therapeutic Medicine', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Directorate of Reproductive, Maternal, Newborn, Child and Adolescent Health', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'General Directorate of Monitoring, Evaluation and Health Information System', 'directorate_id' => DeputyMinistryEnum::PlanAndPolicy->value],
    // ['name' => 'Directorate of guidance and invitation', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'General Directorate of Policy and Planning', 'directorate_id' => DeputyMinistryEnum::PlanAndPolicy->value],
    // ['name' => "Directorate for the Protection of Children and Mothers' Health Rights", 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'General Directorate of Disease Prevention and Control', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Primary Health Care Directorate', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Department of Expertise', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Directorate of Internal Audit', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'Finance and Accounting Department', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'General Directorate of Human Resources', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'Department of Capacity Development', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'Department of International Relations', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Administrative director', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
    // ['name' => 'ICU project', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Non-Communicable Disease Control Department', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'National Accreditation Authority Emeritus', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Health Promotion Authority', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Medical Equipment Procurement Project Coordination Office', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'National Cancer Program and Control Directorate', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Directorate of Legal Affairs', 'directorate_id' => DeputyMinistryEnum::PlanAndPolicy->value],
    // ['name' => 'Department of Public Relations', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Provincial health department', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Department of Legal and Legislative Affairs', 'directorate_id' => DeputyMinistryEnum::PlanAndPolicy->value],
    // ['name' => 'Head of the National Drug Treatment Program', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Ghazanfar Institute of Health Sciences', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Directorate General of the National Institute of Public Health', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'President of the Nurses and Midwives Council', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Department of Environmental Health', 'directorate_id' => DeputyMinistryEnum::ServiceProviding->value],
    // ['name' => 'Directorate of Health Coordination Abroad', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    // ['name' => 'Overseas Coordination Directorate', 'directorate_id' => DeputyMinistryEnum::DeputyMinistry->value],
    ['name' => 'Information Technology Directorate', 'directorate_id' => DeputyMinistryEnum::AdministrativeAndFinancial->value],
];

foreach ($directorates as $item) {
    Directorate::create([
        'directorate_type_id' => DirectorateTypeEnum::Directorate->value,
        'name' => $item['name'],
        'directorate_id' => $item['directorate_id'],
    ]);
}

    }
}
