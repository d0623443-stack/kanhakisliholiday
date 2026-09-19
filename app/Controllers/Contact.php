<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ContentModel;
use App\Models\SettingModel;
use App\Models\EnquiryModel;

class Contact extends BaseController
{
    public function index(): string
    {
        helper(['form']);

        $contentModel = new ContentModel();
        $settingModel = new SettingModel();

        $content  = $contentModel->getPageContent('contact');
        $settings = $settingModel->getAllSettings();

        $data = [
            'metaTitle'           => 'Plan Your Kanha Visit — Contact Kanha Kisli Holiday',
            'metaDescription'     => 'Get in touch for safari booking assistance, peaceful forest accommodation, and personalized Kanha travel guidance.',
            'activeNav'           => 'contact',
            'isTransparentHeader' => true,
            'content'             => $content,
            'settings'            => $settings,
            'validation'          => service('validation'),
        ];

        return view('pages/contact', $data);
    }

    public function enquiry(): RedirectResponse
    {
        helper(['form']);

        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your name.',
                    'min_length' => 'Name should be at least 2 characters.',
                ],
            ],
            'phone' => [
                'label' => 'Phone / WhatsApp',
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Please provide a contact phone number.',
                    'min_length' => 'Please provide a valid phone number.',
                ],
            ],
            'email' => [
                'label' => 'Email Address',
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Please provide a valid email address.',
                ],
            ],
            'interest' => [
                'label' => 'Interested In',
                'rules' => 'required|in_list[safari,stay,combo,general]',
                'errors' => [
                    'required' => 'Please select what you would like assistance with.',
                ],
            ],
            'travel_date' => [
                'label' => 'Preferred Travel Date',
                'rules' => 'permit_empty|max_length[50]',
            ],
            'message' => [
                'label' => 'Message or Preferences',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name        = esc($this->request->getPost('name'));
        $phone       = esc($this->request->getPost('phone'));
        $email       = esc($this->request->getPost('email'));
        $interest    = esc($this->request->getPost('interest'));
        $travel_date = esc($this->request->getPost('travel_date') ?? 'Not specified');
        $message     = esc($this->request->getPost('message') ?? 'None');

        $interestLabels = [
            'safari'  => 'Safari Permits & Drives',
            'stay'    => 'Resort Accommodation',
            'combo'   => 'Safari & Stay Package',
            'general' => 'General Information',
        ];
        $interestTitle = $interestLabels[$interest] ?? ucfirst($interest);

        $enquiryModel = new EnquiryModel();
        $enquiryCode = $enquiryModel->generateEnquiryCode();

        $enquiryModel->insert([
            'enquiry_code'   => $enquiryCode,
            'type'           => $interest,
            'name'           => $name,
            'phone'          => $phone,
            'email'          => $email,
            'date_requested' => $travel_date,
            'timing'         => 'Contact Desk',
            'zone_room'      => $interestTitle,
            'vehicle_type'   => null,
            'adults'         => '1',
            'children'       => '0',
            'meal_plan'      => null,
            'nationality'    => 'Indian',
            'notes'          => $message,
            'status'         => 'new',
        ]);

        $subject = "New Website Enquiry [{$enquiryCode}]: {$name} - {$interestTitle}";

        $htmlBody = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
            <div style='background-color: #234B35; color: #fff; padding: 18px 24px;'>
                <h2 style='margin: 0; font-size: 20px;'>New Website Enquiry [{$enquiryCode}]</h2>
                <p style='margin: 4px 0 0; font-size: 13px; opacity: 0.85;'>Kanha Kisli Holiday Desk</p>
            </div>
            <div style='padding: 24px;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 14px;'>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold; width: 140px;'>Enquiry Code:</td><td><strong style='color:#234B35;'>{$enquiryCode}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Full Name:</td><td>{$name}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Phone / WhatsApp:</td><td><a href='tel:{$phone}'>{$phone}</a></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Email:</td><td><a href='mailto:{$email}'>{$email}</a></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Interested In:</td><td><strong>{$interestTitle}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Travel Date:</td><td>{$travel_date}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Message / Request:</td><td>" . nl2br($message) . "</td></tr>
                    <tr><td style='padding: 8px 0; font-weight: bold;'>Received At:</td><td>" . date('Y-m-d H:i:s T') . "</td></tr>
                </table>
            </div>
            <div style='background-color: #f9f9f9; padding: 12px 24px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee;'>
                Notification dispatched from Kanha Kisli Holiday Website &middot; Stored in Database as {$enquiryCode}
            </div>
        </div>";

        if (function_exists('send_mail_notification')) {
            send_mail_notification($subject, $htmlBody, $email, $name);
        }

        return redirect()->to('contact')->with(
            'success',
            "Thank you for reaching out, {$name}! We have received your enquiry ({$enquiryCode}) and our team will get in touch shortly to assist with your Kanha visit."
        );
    }

    public function taxiEnquiry(): RedirectResponse
    {
        helper(['form']);

        $rules = [
            'name' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Please provide your full name.',
                    'min_length' => 'Name must be at least 3 characters long.',
                ],
            ],
            'phone' => [
                'rules'  => 'required|min_length[10]|max_length[15]',
                'errors' => [
                    'required'   => 'Please enter your contact phone or WhatsApp number.',
                    'min_length' => 'Please provide a valid 10-digit phone number.',
                ],
            ],
            'pickup_location' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Please select or enter your pick-up location.',
                ],
            ],
            'drop_location' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Please select or enter your drop destination.',
                ],
            ],
            'travel_date' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Please select your travel / pickup date.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(base_url('/#taxi-transfers'))
                ->withInput()
                ->with('taxi_errors', $this->validator->getErrors())
                ->with('open_taxi_modal', true);
        }

        $name            = trim((string)$this->request->getPost('name'));
        $phone           = trim((string)$this->request->getPost('phone'));
        $email           = trim((string)$this->request->getPost('email'));
        $pickup_location = trim((string)$this->request->getPost('pickup_location'));
        $drop_location   = trim((string)$this->request->getPost('drop_location'));
        $travel_date     = trim((string)$this->request->getPost('travel_date'));
        $pickup_time     = trim((string)$this->request->getPost('pickup_time'));
        $vehicle_type    = trim((string)$this->request->getPost('vehicle_type')) ?: 'AC Cab Transfer';
        $passengers      = trim((string)$this->request->getPost('passengers')) ?: 'Standard';
        $luggage         = trim((string)$this->request->getPost('luggage')) ?: 'Standard';
        $trip_type       = trim((string)$this->request->getPost('trip_type')) ?: 'One Way Transfer';
        $message         = trim((string)$this->request->getPost('message'));

        $enquiryModel = new EnquiryModel();
        do {
            $enquiryCode = 'TAX-' . rand(1000, 9999);
            $exists = $enquiryModel->where('enquiry_code', $enquiryCode)->first();
        } while ($exists);

        $routeSummary = "{$pickup_location} → {$drop_location}";

        $notesArray = [];
        if ($trip_type && $trip_type !== 'One Way Transfer') {
            $notesArray[] = "Trip: {$trip_type}";
        }
        if ($pickup_time) {
            $notesArray[] = "Pickup Time: {$pickup_time}";
        }
        if ($message) {
            $notesArray[] = "Notes: {$message}";
        }
        $fullNotes = implode(" | ", $notesArray);

        $enquiryModel->insert([
            'enquiry_code'   => $enquiryCode,
            'type'           => 'taxi',
            'name'           => $name,
            'phone'          => $phone,
            'email'          => $email ?: null,
            'date_requested' => $travel_date,
            'timing'         => $pickup_time ?: 'Flexible',
            'zone_room'      => $routeSummary,
            'vehicle_type'   => $vehicle_type,
            'adults'         => $passengers,
            'children'       => $luggage,
            'meal_plan'      => null,
            'nationality'    => 'Indian',
            'notes'          => $fullNotes,
            'status'         => 'new',
        ]);

        // Admin Email Notification
        $subject = "New Taxi Transfer Enquiry [{$enquiryCode}]: {$name} - {$pickup_location} to {$drop_location}";

        $htmlBody = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
            <div style='background-color: #234B35; color: #fff; padding: 18px 24px;'>
                <h2 style='margin: 0; font-size: 20px;'>New Taxi Transfer Enquiry [{$enquiryCode}]</h2>
                <p style='margin: 4px 0 0; font-size: 13px; opacity: 0.85;'>Kanha Kisli Holiday &middot; Transport & Cab Desk</p>
            </div>
            <div style='padding: 24px;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 14px;'>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold; width: 150px;'>Enquiry Code:</td><td><strong style='color:#234B35;'>{$enquiryCode}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Guest Name:</td><td>{$name}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Phone / WhatsApp:</td><td><a href='tel:{$phone}' style='color:#234B35; font-weight:bold;'>{$phone}</a></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Route:</td><td><strong>{$pickup_location} &rarr; {$drop_location}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Travel Date:</td><td><strong>{$travel_date}</strong></td></tr>
                    " . ($email ? "<tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Email:</td><td><a href='mailto:{$email}'>{$email}</a></td></tr>" : "") . "
                    " . ($message ? "<tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Special Notes:</td><td>" . nl2br(htmlspecialchars($message)) . "</td></tr>" : "") . "
                    <tr><td style='padding: 8px 0; font-weight: bold;'>Received At:</td><td>" . date('Y-m-d H:i:s T') . "</td></tr>
                </table>
            </div>
            <div style='background-color: #f9f9f9; padding: 12px 24px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee;'>
                Notification dispatched from Kanha Kisli Holiday Website &middot; Stored in Database as {$enquiryCode}
            </div>
        </div>";

        if (function_exists('send_mail_notification')) {
            send_mail_notification($subject, $htmlBody, $email ?: null, $name);

            // Send polite confirmation to guest if email was provided
            if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $guestSubject = "Taxi Transfer Enquiry Received [{$enquiryCode}] — Kanha Kisli Holiday";
                $guestBody = "
                <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
                    <div style='background-color: #234B35; color: #fff; padding: 20px 24px;'>
                        <h2 style='margin: 0; font-size: 20px;'>Taxi Booking Enquiry Confirmation</h2>
                        <p style='margin: 4px 0 0; font-size: 13px; opacity: 0.85;'>Kanha Kisli Holiday &middot; Private Wilderness Transfers</p>
                    </div>
                    <div style='padding: 24px;'>
                        <p>Dear <strong>{$name}</strong>,</p>
                        <p>Thank you for choosing <strong>Kanha Kisli Holiday</strong> for your travel arrangements. We have received your taxi transfer enquiry under reference <strong>{$enquiryCode}</strong>.</p>
                        <div style='background: #fbfaf6; border: 1px solid #eadfcb; border-radius: 6px; padding: 16px; margin: 16px 0;'>
                            <table style='width: 100%; font-size: 14px; border-collapse: collapse;'>
                                <tr><td style='padding: 4px 0; color: #666; width: 140px;'>Reference:</td><td><strong>{$enquiryCode}</strong></td></tr>
                                <tr><td style='padding: 4px 0; color: #666;'>Route:</td><td><strong>{$pickup_location} &rarr; {$drop_location}</strong></td></tr>
                                <tr><td style='padding: 4px 0; color: #666;'>Travel Date:</td><td><strong>{$travel_date}</strong></td></tr>
                                <tr><td style='padding: 4px 0; color: #666;'>Vehicle:</td><td>{$vehicle_type}</td></tr>
                                <tr><td style='padding: 4px 0; color: #666;'>Trip Type:</td><td>{$trip_type}</td></tr>
                            </table>
                        </div>
                        <p>Our dedicated transport coordinator will review vehicle availability and contact you shortly via <strong>WhatsApp / Phone ({$phone})</strong> with confirmed driver details, fixed transparent pricing, and pickup confirmation.</p>
                        <p style='margin-top: 20px;'>Warm regards,<br><strong>Kanha Kisli Holiday Travel Desk</strong><br>Website: kanhakisliholiday.in</p>
                    </div>
                </div>";

                send_mail_notification($guestSubject, $guestBody, null, null, false, $email);
            }
        }

        return redirect()->to(base_url('/#taxi-transfers'))->with(
            'success',
            "Thank you, {$name}! Your taxi transfer enquiry ({$enquiryCode}) for {$pickup_location} to {$drop_location} has been received. Our travel desk has dispatched notification to our email and will contact you via WhatsApp / Phone ({$phone}) shortly."
        );
    }
}
