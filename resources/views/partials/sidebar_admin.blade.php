<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo d-flex justify-content-center mb-3">
    <a href="{{ route('dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo">
        <img src="{{ asset('assets/img/EcoFlux1.svg') }}" alt="Logo EcoFlux" style="width: 240px; height: auto;">
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-tachometer"></i>
        <div data-i18n="Analytics">Tableau de bord</div>
      </a>
    </li>

    <!-- Opération -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-recycle"></i>
        <div data-i18n="Layouts">Opération</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="layouts-without-menu.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-map"></i>
            <div data-i18n="Without menu">Zones</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-without-navbar.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-calendar"></i>
            <div data-i18n="Without navbar">Planification</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-container.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-show"></i>
            <div data-i18n="Container">Suivi et Rapports</div>
          </a>
        </li>


      </ul>
    </li>

    <!-- Annuaire -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Account Settings">Gestion des Utilisateurs</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="pages-account-settings-account.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Account">Client</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-account-settings-notifications.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-shield"></i>
            <div data-i18n="Notifications">Agents</div>
          </a>
        </li>

        <li class="menu-item">
          <a href="pages-account-settings-connections.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div data-i18n="Connections">Collecteurs</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Stock -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div data-i18n="User interface">Stock</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="ui-accordion.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-box"></i>
            <div data-i18n="Accordion">Produits</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-alerts.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-list-check"></i>
            <div data-i18n="Alerts">Inventaire</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-alerts.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-transfer"></i>
            <div data-i18n="Alerts">Mouvements</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-alerts.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-bell"></i>
            <div data-i18n="Alerts">Alertes stock</div>
          </a>
        </li>
      </ul>
    </li>


    <!-- Forms & Tables -->
     <!-- <li class="menu-header small text-uppercase">
     <span class="menu-header-text">Forms &amp; Tables</span>
    </li>  -->
    <!-- Ventes -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
        <div data-i18n="Form Elements">Ventes</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="forms-basic-inputs.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cart"></i>
            <div data-i18n="Basic Inputs">Commande</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="forms-input-groups.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-credit-card"></i>
            <div data-i18n="Input groups">Paiement</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="forms-input-groups.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div data-i18n="Input groups">Liste des Paiement</div>
          </a>
        </li>

      </ul>
    </li>


  <!-- Configuration -->
<li class="menu-header small text-uppercase">
<span class="menu-header-text">Configuration</span>
 </li>

  <li class="menu-item">
 <a href="javascript:void(0);" class="menu-link menu-toggle">
<i class="menu-icon tf-icons bx bx-cog"></i>
<div>Paramètres système</div>
 </a>



<!-- Paramètres plateforme -->


<!-- Notifications -->
<li class="menu-item">
  <a href="#" class="menu-link">
    <i class="menu-icon tf-icons bx bx-bell"></i>
    <div>Notifications</div>
  </a>
</li>
<!-- Logs -->
<li class="menu-item">
  <a href="#" class="menu-link">
    <i class="menu-icon tf-icons bx bx-history"></i>
    <div>Historique système</div>
  </a>
</li>


 </ul>
 </li>
    <!-- Components -->
     <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li> -->

    <!-- User interface -->
  </ul>
</aside>