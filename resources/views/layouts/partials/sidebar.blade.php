
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
            <li class="menu-item">
              <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div data-i18n="Analytics">Tableau de bord</div>
              </a>
            </li>

           <li class="menu-item">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-recycle"></i>
    <div>Opération</div>
  </a>
  <ul class="menu-sub">
    <li class="menu-item">
      <a href="{{ route('zones.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-map"></i>
        <div>Zones</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('planifications.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-calendar"></i>
        <div>Planification</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('suivi_collecte.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-show"></i>
        <div>Suivi des collectes</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('rapports.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
        <div>Rapports statistiques</div>
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
                  <a href="{{ route('clients.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Account">Client</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('agents.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-shield"></i>
                    <div data-i18n="Notifications">Agents</div>
                  </a>
                </li>
               
                <li class="menu-item">
                  <a href="{{ route('collecteurs.index') }}" class="menu-link">
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
                  <a href="{{ route('produits.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="Accordion">Produits</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('inventaire.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-list-check"></i>
                    <div data-i18n="Alerts">Inventaire</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('stock-entree.create') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-plus-circle"></i>
                    <div data-i18n="Alerts">Entrée Stock</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('mouvements.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-transfer"></i>
                    <div data-i18n="Alerts">Mouvements</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('alertes.index') }}" class="menu-link">
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
                  <a href="{{ route('commandes.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cart"></i>
                    <div data-i18n="Basic Inputs">Commande</div>
                  </a>
                </li>
             
                <li class="menu-item">
                  <a href="{{ route('paiements.create') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-credit-card"></i>
                    <div data-i18n="Input groups">Paiement</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('paiements.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-receipt"></i>
                    <div data-i18n="Input groups">Liste des Paiement</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('abonnements.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div>Abonnements</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('abonnements.create') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-plus-circle"></i>
                    <div>Nouvel abonnement</div>
                  </a>
                </li>
              
              </ul>
            </li>

         
           
            
          <!-- Configuration -->
    <li class="menu-header small text-uppercase">
  <span class="menu-header-text">Configuration</span>
     </li>

    <li class="menu-item">
      <a href="{{ route('parametres.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div>Paramètres système</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('notifications.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-bell"></i>
        <div>Notifications</div>
      </a>
    </li>

            <!-- Components -->
             <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li> -->
           
            <!-- User interface -->
          </ul>
        </aside>