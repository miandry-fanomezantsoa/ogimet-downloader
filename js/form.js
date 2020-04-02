function checkIcaoCode(element) {
	return (element.val() && element.val().length == 4 && !(/[0-9]/.test(element.val()))) ? "" : "Entrer un code OACI valide comportant quatre lettres sans aucun chiffre";
}

function checkDateFrom(dt){
	var dateRef = new Date('2004-01-01');
	var from_date = new Date(dt);
	return (from_date < dateRef) ? "Entrer une date de 2020" : "";
}

function checkDateTo(dt_to, dt_from){ 
	var dateRef = new Date('2004-01-01');
	var from_date = new Date(dt_from);
	var to_date = new Date(dt_to);
	return (to_date < dateRef || to_date < from_date) ? "Entrer une date ultérieure à la date de commencement" : "";
}

/*class Metar {

	constructor(message) {


		this.type =
		this.correction = 
		this.station =
		this.date =
		this.auto =
		this.nil =
		this.winds = 
		this.visi =
		this.pvp =
		this.phenos =
		this.clouds =
		this.temp =
		this.pressure =
		this.recent_phenos =
		this.ws =
		this.trend = 
	}
}

class Trend {

	constructor() {


		this.type =
		this.date =
		this.winds =
		this.visi =
		this.phenos =
		this.clouds =
	}
}

class Wind {

	constructor() {
		this.avg_dir =
		this.min_dir =
		this.max_dir =
		this.velocity = 
		this.gust =
	}
}

class Cloud {

	constructor() {
		this.nebu = 
		this.level =

	}
}*/

$(function(){
	
	var monthBetween = function(date1, date2) {
		var dY = Math.abs(date1.getFullYear() - date2.getFullYear())
		var dM = Math.abs(date1.getMonth() - date2.getMonth())
		return (dY * 12) + dM
	}

	var getMetar = function(begin, end) {
		$.ajax('https://www.ogimet.com/display_metars2.php', {
			type: 'GET',
			dataType: 'json',
			data: {
				lang: 'en',
				lugar: $('#icao-code').val(),
				tipo: 'ALL',
				ord: 'DIR',
				nil: 'SI',
				fmt: 'txt',
				ano: moment(begin).format('YYYY'),
				mes: moment(begin).format('MM'),
				day: moment(begin).format('DD'),
				hora: moment(begin).format('HH'),
				anof: moment(end).format('YYYY'),
				mesf: moment(end).format('MM'),
				dayf: moment(end).format('DD'),
				horaf: moment(end).format('HH'),
				minf: moment(end).format('mm'),
				send: 'send'
			},
			success: function(data) {
				return data
			},
			error: function(xhr, status, err_msg) {
				throw new Error('AJAX request error : '+ err_msg)
			},
			crossDomaine: true
		});
	}

	/*$('#request-form').on('submit', function(event) {
		event.preventDefault();*/

		/********** Validation of all elements of the form *******************/
		/*$('#icao-code-error').html(checkIcaoCode($('#icao-code input')));
		$('#from-date-error').html(checkDateFrom($('#from-date').val()));
		$('#to-date-error').html(checkDateTo($('#to-date').val(), $('#from-date').val()));
*/
		//if (!(checkIcaoCode($('#icao-code input')) || checkDateFrom($('#from-date').val()) || checkDateTo($('#to-date').val(), $('#from-date').val()))) {
			/********** All form's elements are validated ****************/
			
			/*var df = new Date($('#from-date').val() + ' ' + $('#from-time').val())
			var dt = new Date($('#to-date').val() + ' ' + $('#to-time').val())
			var diff = monthBetween(dt, df)

			var error_messages = "";

			if(diff === 0) {
				let response;
				try {
					response = getMetar(df, dt)
					$('#result').append(response)
				} catch(e) {
					error_messages += 'ERREUR lors de la récupération des messages entre '+moment(df).format('YYYY-MM-DD HH:mm')+' et '+moment(dt).format('YYYY-MM-DD HH:mm')+ e.message + '\n'
				}
				
			} else {
				for(var i = 0;i <= diff; i++) {
					let response;
					if(i == diff) {
						try {
							response = getMetar(moment(df).add(i, 'months').startOf('month').toDate(), dt)
						} catch(e) {
							error_messages += 'ERREUR lors de la récupération des messages entre '+moment(df).add(i, 'months').startOf('month').format('YYYY-MM-DD HH:mm')+' et '+moment(dt).format('YYYY-MM-DD HH:mm')+ e.message + '\n'
						}
					} else {
						try {
							response = getMetar(moment(df).add(i, 'months').startOf('month').toDate(), moment(df).add(i, 'months').endOf('month').toDate())
						} catch(e) {
							error_messages += 'ERREUR lors de la récupération des messages entre '+moment(df).add(i, 'months').startOf('month').format('YYYY-MM-DD HH:mm')+' et '+moment(df).add(i, 'months').endOf('month').format('YYYY-MM-DD HH:mm')+ e.message + '\n'
						}
					}
					$('#result').append(response)
				}
			}
			
		}
	});*/

});