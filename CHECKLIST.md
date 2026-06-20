# Aktualizace checklistu

## Fáze 2 – Databázová vrstva

### Instalace

* [x] Activation Hook
* [x] SchemaManager::install()
* [ ] SchemaManager::maybeUpgrade()
* [ ] DB version upgrade test

---

## Fáze 6 – Repository Layer

### Implementace

* [x] MembershipPlanRepository.php
* [x] MembershipRepository.php
* [x] MembershipBenefitRepository.php
* [x] MembershipPaymentRepository.php
* [x] MembershipEventRepository.php

---

## Fáze 7 – Service Layer

### Core Services

* [x] MembershipPlanService.php
* [x] MembershipService.php
* [x] MembershipBenefitService.php
* [x] MembershipPaymentService.php
* [x] MembershipEventService.php

### Business Services

* [x] MembershipActivationService.php
* [x] MembershipRenewalService.php
* [x] MembershipExpirationService.php
* [x] MembershipCancellationService.php

---

## Nová Fáze 7A – Dependency Injection

* [x] ServiceContainer.php
* [x] MembershipServiceProvider.php
* [x] AdminServiceProvider.php
* [ ] Integration providers
* [ ] Service container tests

---

## Fáze 10 – Admin

### Screens

* [x] PlansScreen.php
* [x] MembershipsScreen.php
* [x] PaymentsScreen.php
* [x] EventsScreen.php

### ViewModels

* [x] PlansViewModel.php
* [x] MembershipsViewModel.php
* [x] PaymentsViewModel.php
* [x] EventsViewModel.php

### Renderers

* [x] PlansRenderer.php
* [x] MembershipsRenderer.php
* [x] PaymentsRenderer.php
* [x] EventsRenderer.php

### Templates

* [x] plans-list.php
* [x] memberships-list.php
* [x] payments-list.php
* [x] events-list.php

### Menu

* [x] AdminMenu.php

---

## Nová Fáze 10A – Localization

* [x] load_plugin_textdomain()
* [x] Text domain registration
* [x] languages directory
* [x] Localization bootstrap
* [ ] POT generation
* [ ] Translation switcher
* [ ] Locale resolver

---

## Nová Fáze 10B – Integrations

* [x] pwmp_integrations_loaded hook
* [x] Integration architecture foundation
* [ ] Google Sheets addon
* [ ] Translator addon
* [ ] CRM addon
* [ ] Webhook addon

---

## Nová Fáze 10C – Bootstrap

* [x] PWMP_VERSION
* [x] PWMP_PATH
* [x] PWMP_URL
* [x] PWMP_FILE
* [x] Bootstrap initialization
* [ ] Bootstrap tests

