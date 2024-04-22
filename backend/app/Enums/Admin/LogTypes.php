<?php

namespace App\Enums\Admin;

use ArchTech\Enums\Values;

enum LogTypes: string
{
  use Values;
  case ApproveUser  = 'Approve user';
  case ApproveUserSent  = 'Approve user sent';
  case ApproveUserFail  = 'Approve user fail';
  case ActivateRestaurant  = 'Activate restaurant';
  case ActivateRestaurantNotifySent  = 'Activate restaurant sent';
  case ActivateRestaurantNotifyFail  = 'Activate restaurant fail';
  case CreatePromoter  = 'Create promoter';
  case CreateUser  = 'Create user';
  case UpdateProfile  = 'Update profile';
  case DeleteRestaurant  = 'Delete restaurant';
  case DeleteUser  = 'Delete user';
  case DeletePromoter  = 'Delete promoter';
  case UpdateSettings  = 'Update central settings';
  case UpdateRevenueSettings  = 'Update revenue settings';
  case UpdateUserPermissions  = 'Update user permissions';
  case DenyRestaurant  = 'Deny restaurant';
  case DenyUserSent  = 'Deny user sent';
  case DenyUserFail  = 'Deny user fail';
  case DownloadCommercialFile  = 'Download commercial file';
  case DownloadDeliveryContract  = 'Download delivery contract';
  case DownloadTaxNumber  = 'Download tax number';
  case DownloadBankCertificate  = 'Download bank certificate';
  case CreateNewRestaurant  = 'Create new restaurant';
  case ApproveBusinessSent  = 'Approve business sent';
  case ApproveBusinessFail  = 'Approve business fail';
  case VerifyRestaurantUserSent  = 'Verify restaurant user sent';
  case VerifyRestaurantUserFail  = 'Verify restaurant user fail';
  case RenewSubscriptionNotifySent ="Notify To Renew Subscription sent";
  case RenewSubscriptionNotifyFail ="Notify To Renew Subscription fail";
  case TAPLeadIDMerchantIDSent ="TAP request to create Merchant ID from Lead ID sent";
  case TAPLeadIDMerchantIDFail ="TAP request to create Merchant ID from Lead ID fail";
  case TAPRestaurantMerchantID ="Update restaurant merchant id";
  case ContactUsForm ="Contact US Form";
  case UserSubscriptionNotifySent ="Notify for new/renew website restaurant subscription sent";
  case UserSubscriptionNotifyFail ="Notify for new/renew website restaurant subscription fail";
  case UserAppSubscriptionNotifySent ="Notify for new/renew customer application subscription sent";
  case UserAppSubscriptionNotifyFail ="Notify for new/renew customer application subscription fail";
}
