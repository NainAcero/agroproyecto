<div>
    	<!--main area-->
	<main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">Inicio</a></li>
					<li class="item-link"><span>Contactos</span></li>
				</ul>
			</div>
			<div class="row">
				<div class=" main-content-area">
					<div class="wrap-contacts ">
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            @if (session('notification'))
                                <div class="alert alert-success">
                                    <strong>Success</strong> {{ session('notification') }}
                                </div>
                            @endif
							<div class="contact-box contact-form">
								<h2 class="box-title">DEJANOS UN MENSAJE</h2>
								<form action="{{ route('mensaje') }}" method="POST" name="frm-contact">
                                    @csrf
									<label for="name">Name<span>*</span></label>
									<input type="text" value="" id="name" name="name" >

									<label for="email">Email<span>*</span></label>
									<input type="email" value="" id="email" name="email" >

									<label for="phone">Teléfono</label>
									<input type="text" value="" id="phone" name="telefono" >

									<label for="comentario">Comentario</label>
									<textarea name="comentario" id="comentario"></textarea>

									<input type="submit" name="ok" value="Enviar" >

								</form>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
							<div class="contact-box contact-info">
								<div class="wrap-map">
									<div class="mercado-google-maps"
										 id="az-google-maps57341d9e51968"
										 data-hue=""
										 data-lightness="1"
										 data-map-style="2"
										 data-saturation="-100"
										 data-modify-coloring="false"
										 data-title_maps="AGROVIC TORRES"
										 data-phone="(052) 424 394"
										 data-email="agrovid@torres.com"
										 data-address="Prolongación Patricio Melendez 583 – Tacnan"
										 data-longitude="-70.2493055"
										 data-latitude="-18.007446"
										 data-pin-icon=""
										 data-zoom="16"
										 data-map-type="ROADMAP"
										 data-map-height="263">
									</div>
								</div>
								<h2 class="box-title">DETALLES DEL CONTACTO</h2>
								<div class="wrap-icon-box">

									<div class="icon-box-item">
										<i class="fa fa-envelope" aria-hidden="true"></i>
										<div class="right-info">
											<b>Email</b>
											<p>agrovid@torres.com</p>
										</div>
									</div>

									<div class="icon-box-item">
										<i class="fa fa-phone" aria-hidden="true"></i>
										<div class="right-info">
											<b>Teléfono</b>
											<p>(052) 424 394</p>
										</div>
									</div>

									<div class="icon-box-item">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										<div class="right-info">
											<b>Dirección</b>
											<p>Prolongación Patricio Melendez 583 – Tacna</p>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->

</div>
