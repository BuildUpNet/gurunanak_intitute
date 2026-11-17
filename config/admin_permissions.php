<?php

/*
|--------------------------------------------------------------------------
| Admin Panel Permissions
|--------------------------------------------------------------------------
| Every permission a staff role can be given. The key is what routes check
| (middleware "can:<key>") and what gets stored in roles.permissions.
| Super admin (users.role = 'admin') always has everything, plus the
| super-admin-only screens: Users, Roles and API Access.
*/

return [
    'forms.view' => [
        'group' => 'Forms',
        'label' => 'View Forms',
        'description' => 'Admission applications, Contact enquiries and Quick enquiries (read only).',
    ],
    'forms.export' => [
        'group' => 'Forms',
        'label' => 'Export Forms to Excel',
        'description' => 'Download the form lists as Excel files.',
    ],
    'gallery.manage' => [
        'group' => 'Gallery',
        'label' => 'Manage Gallery',
        'description' => 'Add, edit and delete gallery categories, sub categories and images.',
    ],
    'programs.manage' => [
        'group' => 'Content',
        'label' => 'Manage Programs & Schools',
        'description' => 'Program categories, schools, courses, program detail pages and nav cards.',
    ],
    'announcements.manage' => [
        'group' => 'Content',
        'label' => 'Manage Announcements',
        'description' => 'Add, edit, delete and toggle announcements.',
    ],
    'hero_slides.manage' => [
        'group' => 'Content',
        'label' => 'Manage Hero Slider',
        'description' => 'Home page hero slides.',
    ],
    'about_images.manage' => [
        'group' => 'Content',
        'label' => 'Manage About Images',
        'description' => 'Images shown on the About page.',
    ],
    'awards.manage' => [
        'group' => 'Content',
        'label' => 'Manage Awards & Recognitions',
        'description' => 'Sections & images on the Awards & Recognition page.',
    ],
    'faqs.manage' => [
        'group' => 'Content',
        'label' => 'Manage FAQs',
        'description' => 'Add, edit and delete FAQs.',
    ],
];
