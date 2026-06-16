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

### Changed

* Refactored MembershipPlanRepository to use AbstractRepository
* Centralized common database operations in AbstractRepository

### Security

* Updated PHPUnit to 9.6.34
* Composer audit reports no known vulnerabilities

### Planned

#### Repositories

* MembershipRepository
* MembershipBenefitRepository
* MembershipPaymentRepository
* MembershipEventRepository

#### Services

* MembershipPlanService
* MembershipService
* MembershipBenefitService
* MembershipPaymentService
* MembershipEventService

#### Membership Lifecycle

* MembershipActivationService
* MembershipRenewalService
* MembershipExpirationService
* MembershipCancellationService

#### Admin

* PlansScreen
* MembershipsScreen
* PaymentsScreen
* EventsScreen

#### API

* Membership endpoints
* Purchase endpoints
* Membership history endpoints

#### Payments

* Stripe integration
* Comgate integration
* GoPay integration

