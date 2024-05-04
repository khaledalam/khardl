<?php

return [
    'denied_message' => [
        'title' => 'Denied',
        'content' => [
            'intro' => 'Dear :firstName,',
            'denied_reason' => 'We regret to inform you that your account request has been denied. Our team has reviewed your information and determined that it does not meet our criteria for approval at this time.',
            'reason_details' => 'Reason for Denial: Upon careful consideration, we have found that certain information provided does not align with our requirements or guidelines.',
            'next_steps' => 'Next Steps:',
            'next_steps_description' => 'We understand that you may need to update or modify certain details in order to meet our criteria. To proceed further, please click on the button below to access your account and make the necessary changes. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team. We appreciate your understanding and cooperation.',
            'thank_you' => 'Thank you',
            'email_note' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.'
        ],
        'buttons' => [
            'proceed_to_update' => 'Proceed to Update'
        ]
    ],
    'subscription_suspended' => [
        'title' => 'Subscription Suspended',
        'content' => [
            'intro' => 'Dear :firstName,',
            'suspended_message' => 'We hope this message finds you well. We regret to inform you that your current subscription for the restaurant ":restaurantName" has been suspended.',
            'renewal_instructions' => 'To proceed with the renewal and start receiving orders again, please follow this link:',
            'renew_link' => 'Renew Subscription',
            'website_subscription' => 'Renew Subscription',
            'app_subscription' => 'Renew Subscription',
            'thank_you_message' => 'Thank you for choosing our services. We value your partnership and look forward to continuing our collaboration.',
            'email_note' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
            'message3' => 'Our team is ready to assist you throughout the process and answer any questions you may have.',
            'message1' => 'Unfortunately, your customers cannot place orders through the app until your subscription is renewed. To proceed with the renewal and start receiving orders again, please follow this link:'
        ]
    ],
    'subscription_expired' => [
        'title' => 'Subscription Expired',
        'message_intro' => 'Dear :first_name',
        'message_body' => 'We hope this message finds you well. We regret to inform you that your current subscription for the restaurant :restaurant_name has expired. To ensure the uninterrupted activity of your restaurant and to continue providing excellent service to your customers, we\'re offering you a grace period of :period_time days to renew your subscription.',
        'website_renewal' => 'To proceed with the renewal, please follow this link:',
        'app_renewal' => 'Unfortunately, your customers cannot place orders through the app after this grace period. To proceed with the renewal, please follow this link:',
        'thank_you' => 'Thank you for choosing our services. We value your partnership and look forward to continuing our collaboration.',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
    ],
    'app_completed' => [
        'title' => 'Mobile App Completed',
        'greeting' => 'Dear :name',
        'message' => 'Your new mobile app has been successfully added to your restaurant, you can access it by going to the services page.',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
    ],
    'approved_business' => [
        'greeting' => 'Dear :first_name ,',
        'message1' => 'We are delighted to inform you that your business request with reference :business_id has been successfully approved! We appreciate your partnership and look forward to continuing our collaboration.',
        'message2' => 'To proceed with the next steps, we invite you to purchase your new subscription by following this URL',
        'message3' => 'Our team is ready to assist you throughout the process and answer any questions you may have.',
        'message4' => 'Thank you for choosing our services. We value your business and are committed to providing you with the best experience.',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
    ],
    'approved_restaurant' => [
        'greeting' => 'Dear :first_name,',
        'message1' => 'We are pleased to inform you that your restaurant has been approved and is now live on our platform. Users can access your restaurant at the following URL:',
        'message2' => 'Thank you for choosing our platform. If you have any questions or need further assistance, feel free to contact us.',
        'message3' => 'Best regards,',
        'signature' => 'Khardl',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
    ],
    'contact_us' => [
        'message' => 'New form request.',
        'form_details' => 'Form Details',
        'contact_id' => 'Contact ID : #',
        'email' => 'Email : ',
        'phone_number' => 'Phone Number : ',
        'business_name' => 'Business Name : ',
        'person_name' => 'Person Name : ',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
    ],
    'verify' => [
        'verify_email_subject' => 'Verify Your Email Account',
        'dear_name' => 'Dear :name,',
        'verification_code_message' => 'Thanks for registering to Khardl, your verification code is:',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
    ],
    'password' => [
        'password_recovery' => 'Password Recovery',
        'dear_user' => 'Dear :name,',
        'reset_password' => 'Reset your password',
        'recovery_code' => 'Your recovery code is:',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.',
    ],
    'notify_users_for_new_sub' => [
        'renew-subscription' => 'Renew Subscription',
        'dear_user' => 'Dear :user_name,',
        'notify_message' => 'We wanted to inform you that a new :sub has been booked from :restaurant_name (ID:  :restaurant_id ) on :date. The cost of this subscription is :cost .',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.'
    ],
    'renew_subscription' => [
        'subscription-expired' => 'Subscription Expired',
        'greeting' => 'Dear :first_name',
        'subtitle' => 'We hope this message finds you well.',
        'body1' => 'We regret to inform you that your current subscription for the restaurant "{{ $restaurant_name }}" has expired. To ensure the uninterrupted activity of your restaurant and to continue providing excellent service to your customers, we\'re offering you a grace period of :period days to renew your subscription.',
        'body2' => 'To proceed with the renewal, please follow this link:',
        'body3' => 'Renew Subscription. ',
        'body4' => 'Our team is ready to assist you throughout the process and answer any questions you may have.',
        'body5' => 'We regret to inform you that your current subscription for the restaurant :$restaurant_name has expired. To ensure the uninterrupted activity of your restaurant and to continue providing excellent service to your customers, we\'re offering you a grace period of :period days to renew your subscription.',
        'body6' => 'Unfortunately, your customers cannot place orders through the app after this grace period. To proceed with the renewal, please follow this link:',
        'body7' => 'Thank you for choosing our services. We value your partnership and look forward to continuing our collaboration.',
        'email_disclaimer' => 'This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.'
        ]

];

