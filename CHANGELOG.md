# Changelog

## [Unreleased]

### Added

#### Project

* Composer configuration
* PSR-4 autoloading
* PHPUnit setup
* PHPStan setup
* Brain Monkey setup
* Mockery setup
* Infection setup

#### Database

* Added TableInterface
* Added DatabaseVersion
* Added SchemaManager

#### Database Tables

* Added MembershipPlansTable
* Added MembershipsTable
* Added MembershipBenefitsTable
* Added MembershipPaymentsTable
* Added MembershipEventsTable

#### DTO

* Added MembershipPlanDto
* Added MembershipDto
* Added MembershipBenefitDto
* Added MembershipPaymentDto
* Added MembershipEventDto

#### Value Objects

* Added MembershipStatus
* Added PaymentStatus

#### Repository Contracts

* Added MembershipPlanRepositoryInterface
* Added MembershipRepositoryInterface
* Added MembershipBenefitRepositoryInterface
* Added MembershipPaymentRepositoryInterface
* Added MembershipEventRepositoryInterface

#### Repositories

* Added AbstractRepository
* Added MembershipPlanRepository
* Added MembershipRepository
* Added MembershipBenefitRepository
* Added MembershipPaymentRepository
* Added MembershipEventRepository

#### Services

* Added MembershipPlanService
* Added MembershipService
* Added MembershipBenefitService
* Added MembershipPaymentService
* Added MembershipEventService

#### Membership Lifecycle

* Added MembershipActivationService
* Added MembershipRenewalService
* Added MembershipExpirationService
* Added MembershipCancellationService

#### Dependency Injection

* Added ServiceContainer
* Added MembershipServiceProvider
* Added AdminServiceProvider

#### Admin

* Added AdminMenu
* Added PlansScreen
* Added MembershipsScreen
* Added PaymentsScreen
* Added EventsScreen

#### View Models

* Added PlansViewModel
* Added MembershipsViewModel
* Added PaymentsViewModel
* Added EventsViewModel

#### Renderers

* Added PlansRenderer
* Added MembershipsRenderer
* Added PaymentsRenderer
* Added EventsRenderer

#### Templates

* Added plans-list.php
* Added memberships-list.php
* Added payments-list.php
* Added events-list.php

#### Localization

* Added plugin text domain support
* Added localization bootstrap loading
* Added PWMP_FILE constant
* Added PWMP_PATH constant
* Added PWMP_URL constant
* Added PWMP_VERSION constant

#### Integrations

* Added pwmp_integrations_loaded hook
* Added integration extension architecture foundation

### Changed

* Refactored MembershipPlanRepository to use AbstractRepository
* Centralized common database operations in AbstractRepository
* Refactored membership architecture into Repository → Service pattern
* Standardized Admin architecture using Screen → ViewModel → Renderer → Template pattern

### Security

* Updated PHPUnit to 9.6.34
* Composer audit reports no known vulnerabilities
* Added capability checks to admin screens
* Added template existence validation in renderers
* Added strict typing across new services and admin classes

### Planned

#### API

* Membership endpoints
* Purchase endpoints
* Membership history endpoints

#### Payments

* Stripe integration
* Comgate integration
* GoPay integration

#### Integrations

* Google Sheets addon
* Translator addon
* CRM addon
* Webhook addon

#### Localization

* Language switcher
* Locale resolver
* Translation provider contracts

