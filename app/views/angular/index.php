<!doctype html>
<html ng-app="Mashtag">
	<head>
		<link rel="icon" type="image/png" href="favicon.png" />
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body style="padding-top: 70px;">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Mashtag</a
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12" ng-controller="index">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-2 col-md-offset-2">Search for a tag:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" ng-model="tag">
							</div>
						</div>

						<br>
					
						<div class="col-md-8 col-md-offset-2">
							<span class="label label-info">{{ tag }}</span>

							<div class="form-group">
								<div class="col-md-5 col-md-offset-7">
									<input type="text" class="form-control" placeholder="Filter..." ng-model="filter">
								</div>
							</div>

							<table class="table">
								<tr ng-repeat="result in results | filter: filter">
									<td><img src="/img/{{ result.origin | lowercase }}.png"></td>
									<td>{{ result.date * 1000 | date:'yyyy-MM-dd HH:mm:ss Z' }}</td>
									<td><a href="{{ result.url }}" target="_blank">{{ result.title }}</a></td>
									<td>{{ result.user }}</td>
									<td>{{ result.origin }}</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="/js/angular.min.js" type="text/javascript"></script>
		<script src="/js/angular-resource.min.js" type="text/javascript"></script>
		<script src="/js/mashtag.min.js" type="text/javascript"></script>
	</body>
</html>