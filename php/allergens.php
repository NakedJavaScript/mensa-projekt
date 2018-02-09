<?php include_once 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $head_dependencies;
			$sql = "SELECT * FROM benutzer";
			$result = $conn->query($sql);
		?>
		<title>Deklaration der Allergene</title>
	</head>

	<body>
		<?php include 'header.php' ?>
		<div class="container">
			<h1>Deklaration der Allergene</h1>
			<br>
			<p><strong>Allergene</strong><br />
			(GG) Glutenhaltiges Getreide<br />
			(Mil) Milch und Milcherzeugnisse (einschließlich Laktose)<br />
			(Ei) Eier und Eierzeugnisse<br />
			(Erd) Erdnüsse und Erdnusserzeugnisse<br />
			(Nus) Schalenfrüchte (Nüsse)<br />
			(Ses) Sesamsamen und Sesamsamenerzeugnisse<br />
			(Soj) Soja und Sojaerzeugnisse<br />
			(Sel) Sellerie und Sellerieerzeugnisse<br />
			(Sen) Senf und Senferzeugnisse<br />
			(Sch) Schwefeldioxid und Sulfite<br />
			(Lup) Lupinen und Lupinenerzeugnisse<br />
			(F) Fisch und Fischerzeugnisse<br />
			(Kre) Krebstiere und Krebstiererzeugnisse<br />
			(Wei) Weichtiere und Weichtiererzeugnisse
			</p>
			<br/>
			<p>Die Kennzeichnung der Inhaltsstoffe unseres Essensangebots erfolgt mit größter Sorgfalt. Da wir in unserer Mensa und Cafeteria jedoch auch die Allergie auslösenden Inhaltsstoffe verarbeiten, können wir nicht immer zu 100% ausschließen, dass Spuren dieser Allergene ungewollt in den Zubereitungsprozess anderer Speisen gelangen. Gästen, die bereits durch kleinste Mengen dieser Inhaltsstoffe schwere gesundheitliche Schäden erleiden können, bitten und empfehlen wir deshalb dringend, unsere Essensangebote nicht in Anspruch zu nehmen. Änderungen vorbehalten</p>
			<p><strong>Was man über die neue Kennzeichnungspflicht wissen sollte</strong></p>
			<p>Allergenkennzeichnungen bei Lebensmitteln sind seit dem 13.12.14 auch in Schulen Pflicht. Im Folgenden haben wir eine Reihe von möglichen Fragen zusammengestellt, die im Zusammenhang mit der Kennzeichnungspflicht auftreten können.</p>
			<ol>
				<li><strong> Warum werden Allergene jetzt gekennzeichnet? Was galt bisher für Mensen und Cafeterien?</strong></li>
			</ol>
			<p>Bisher galt die gesetzlich vorgeschriebene Allergendeklaration ausschließlich für verpackte Ware. Seit dem 13.12.2014 müssen die 14 häufigsten Allergene, sofern sie als Zutat im jeweiligen Lebensmittel eingesetzt werden, in der Zutatenliste genannt werden. Der Grund für die neue Deklarationspflicht ist, dass in seltenen Fällen Nahrungsmittelallergiker lebensbedrohliche Reaktionen schon nach Verzehr kleinster Mengen des unverträglichen Nahrungsmittels entwickeln. Beim Verzehr von Speisen, die nicht selbst zubereitet wurden, sind daher das Risiko und die Angst groß, eine unbeabsichtigte, allergische Reaktion zu entwickeln. Um die Lebensqualität von Nahrungsmittelallergikern diesbezüglich zu erhöhen, wird die Deklarationspflicht durch eine neue Kennzeichnungsvorschrift auf EU-Ebene, die seit dem 13.12.2014 gilt, auch auf „lose“ Speisen und Getränke, die z.B. durch Restaurants/Mensen/Kantinen, Bäckereien oder Fleischereien angeboten werden, ausgeweitet.</p>
			<ol start="2">
				<li><strong> Es gibt doch mehr als die 14 kennzeichnungspflichtigen Allergene, oder?</strong></li>
			</ol>
			<p>Ein klares „Ja“. Nach der aktuellen Deklarationspflicht müssen aber nur die 14 häufigsten Allergene, die in Europa 90 Prozent der Allergien und Unverträglichkeiten auslösen, gekennzeichnet werden.</p>
			<ol start="3">
				<li><strong> Was ist eine Lebensmittelunverträglichkeit? Was ist der Unterschied zwischen Allergien und Unverträglichkeiten?</strong></li>
			</ol>
			<p>Bei einer Allergie entwickelt das Immunsystem Antikörper gegen eigentlich völlig harmlose Substanzen, wie z.B. Nahrungsmittel. Isst man diese Nahrungsmittel dann wiederholt, kommt es zu einer Abwehrreaktion des Immunsystems mit zum Teil sehr schwerwiegenden Sofortreaktionen, wie Atemnot, Nesselsucht (Urtikaria), Juckreiz und Schwellung der Haut oder Schleimhäute, Magen-Darm-Beschwerden und/ oder Kreislaufbeschwerden bis hin zur Bewusstlosigkeit. Lebensmittelunverträglichkeiten sind sehr vielfältig und können z.B. beim Verzehr von Lebensmittelzusatzstoffen, Milchzucker oder Fruchtzucker auftreten. Das Immunsystem spielt hierbei keine Rolle. Es kommt eher zum Auftreten von Magen-Darm-Beschwerden (Laktose-Intoleranz, Fruktose-Unverträglichkeit) oder auch zu Symptomen an der Haut (Lebensmittelzusatzstoffe).</p>
			<ol start="4">
				<li><strong> Müssen alle gastronomischen Betriebe in Deutschland Allergene kennzeichnen? </strong></li>
			</ol>
			<p>Die neue EU Lebensmittelinformationsverordnung (LMIV) Nr. 1169/2011 sieht vor, dass alle Speisen, die im Rahmen der Gemeinschaftsverpflegung angeboten werden, nach ihrem Gehalt an deklarationspflichtigen Allergenen gekennzeichnet werden müssen. Dies gilt sowohl für die gehobene Gastronomie, für Mensen und Kantinen bis hin zum einfacheren Imbissbetrieb.</p>
			<ol start="5">
				<li><strong> Was ist ein Allergen? Und für wen ist diese Kennzeichnung wichtig?</strong></li>
			</ol>
			<p>Unter einem Allergen versteht man verschiedenste kleine Eiweißstrukturen, die z.B. in pflanzlichen und tierischen Lebensmitteln zu finden sind. In der Regel sind diese Eiweiße völlig harmlos. Bildet das Immunsystem jedoch fälschlicherweise Antikörper gegen diese harmlosen Substanzen aus, so kommt es bei Kontakt mit den Allergenen zu zum Teil starken Überreaktionen des Immunsystems. Da bei einer Allergie auf bestimmte Nahrungsmittel die einzige Therapie der Verzicht ist, ist es für den Allergiker von hoher Bedeutung, bei nicht selbstzubereiteten Speisen, zu erfahren, ob „sein“ Allergen möglichweise enthalten ist. Nur so kann er sich vor unbewusstem Allergenkontakt schützen.</p>
			<ol start="6">
				<li><strong> Welche Allergene werden gekennzeichnet?</strong></li>
			</ol>
			<p>Die folgenden 14 häufigsten Nahrungsmittelallergene sind deklarationspflichtig:</p>
			<ol>
				<li><strong>(GG)</strong> Glutenhaltige Getreide und daraus hergestellte Erzeugnisse (namentlich Weizen, Roggen, Gerste, Hafer, Dinkel, Kamut)</li>
				<li><strong>(Kre)</strong> Krebstiere und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Ei)</strong> Eier und daraus hergestellte Erzeugnisse</li>
				<li><strong>(F)</strong> Fisch und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Erd)</strong> Erdnüsse und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Soj)</strong> Soja und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Mil)</strong> Milch und daraus hergestellte Erzeugnisse (einschließlich Laktose!)</li>
				<li><strong>(Nus)</strong> Schalenfrüchte und daraus hergestellte Erzeugnisse (namentlich Mandeln, Haselnüsse, Walnüsse, Cashewnüsse, Pekannüsse, Pistazien, Paranüsse, Macadamia- oder Queenslandnüsse)</li>
				<li><strong>(Sel)</strong> Sellerie und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Sen)</strong> Senf und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Ses)</strong> Sesamsamen und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Sch)</strong> Schwefeldioxid und Sulfite (ab 10mg/kg oder 10mg/l)) und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Lup)</strong> Lupinen und daraus hergestellte Erzeugnisse</li>
				<li><strong>(Wei)</strong> Weichtiere und daraus hergestellte Erzeugnisse</li>
			</ol>
			<ol start="7">
				<li><strong> Werden auch mögliche Spuren von Allergenen in Speisen gekennzeichnet?</strong></li>
			</ol>
			<p>Auch nach aktueller Lebensmittelinformationsverordnung Nr. 1169/2011 sind die 14 deklarationspflichtigen Allergene nur zu nennen, wenn sie einer Speise laut Rezeptur direkt als Zutat zugesetzt werden, egal in welcher Menge (Ausnahme: SO2/Sulfit). Spuren, also unbeabsichtigte Kontaminationen einer Speise mit den genannten Allergenen, sind rein rechtlich gesehen nicht kennzeichnungspflichtig. In der Cafeteria und in der Mensa wird mit großer Sorgfalt darauf geachtet, Produkte getrennt zu lagern, zuzubereiten und auszugeben. Dennoch können Kreuzkontaminationen sowie technologisch unvermeidbare Vermischungen einzelner Produkte aufgrund der Gegebenheiten in einer Großküche nicht komplett vermieden werden. Um eine „Überkennzeichnung“ zu vermeiden werden Spuren von Allergenen durch den FiT-Verein nicht gekennzeichnet.</p>
			<ol start="8">
				<li><strong> Werden Allergene ab einer bestimmten Temperatur zerstört?</strong></li>
			</ol>
			<p>In der Literatur gibt es keine genauen Angaben, ab welcher Temperatur und über welche Zeit ALLE Allergene in Nahrungsmitteln zerstört werden. Die Lipid-Transfer-Proteine (kommen vor in Erdnüssen, Lupinen, Sellerie und weiteren Gemüse-, Obst- und Nusssorten) sind ebenso wie die Speicherproteine (v.a. relevant in der Erdnuss) extrem hitze- und verdauungsresistent. Deswegen gibt es Allergiker/innen, die auch auf gekochte Nahrungsmittel mit z.T. schweren allergischen Reaktionen reagieren. Diese Proteine sind definitiv auch noch nach Erhitzung über 100°C „aktiv“ und vor allem verantwortlich für sehr schwere, lebensbedrohliche allergische Reaktionen (Anaphylaxie).<br />
			Aber auch bei hitzelabilen Proteinen (nahezu allen Obst- und Gemüsesorten, und auch in Nüssen) ist nicht gesichert, ab welcher Erhitzung die Allergene tatsächlich „unwirksam“ werden. Werden bspw. Haselnüsse bei 140°C 40min geröstet, lösen sie bei 5 von 17 der Haselnussallergiker immer noch allergische Reaktionen aus.</p>
			<ol start="9">
				<li><strong> Sind in allen Gerichten Allergene enthalten? Gibt es auch allergenfreie Gerichte?</strong></li>
			</ol>
			<p>Prinzipiell besitzen fast alle Nahrungsmittel Strukturen, die Allergien auslösen können. Deklarationspflichtig sind aber nur die 14 häufigsten Nahrungsmittelallergene. Da wir alle 14 Allergene in unseren Einrichtungen verwenden, können wir keine Kreuzkontaminationen zu 100% ausschließen. <strong>Zur Sicherheit unserer Gäste verkaufen wir bewusst keine „allergenfreie“ Speisen.</strong></p>
			<ol start="10">
				<li><strong> Wie stellt die Mensa sicher, dass auch alle Allergene einwandfrei deklariert werden? </strong></li>
			</ol>
			<p>Alle Produkte, die über den Einkauf und die Warenannahme in die Einrichtungen gelangen, müssen schon vom Hersteller einwandfrei deklariert sein. Diese Deklaration wird übernommen und ermöglicht somit eine korrekte Deklaration der Speiserezepturen. Diese Rezepturen müssen bei der Speiseproduktion strengstens eingehalten werden. Des Weiteren ist das gesamte Küchenpersonal zur Einhaltung von Personalhygiene und regulären Hygienestandards, die vor, zwischen und nach jedem Arbeitsschritt eingehalten werden müssen, geschult. Dennoch können wir bei all diesen Maßnahmen eine unbewusste Kreuzkontamination nie ausschließen.</p>
			<ol start="11">
				<li><strong> Welche Prozesse in den Einrichtungen sind für eine korrekte Kennzeichnung wichtig?</strong></li>
			</ol>
			<p>Bereits die Mitarbeiter, die den Produkteinkauf abwickeln, tragen dafür Sorge, dass von außen in den Betrieb gelangte Produkte hinsichtlich der 14 Allergene deklariert sind, und dass diese Mitarbeiter bei Änderungen der Rezepturen vom Hersteller bzw. Lieferanten unverzüglich informiert werden. Diese Produktdeklaration ist die Grundlage der Deklaration aller vorhandenen Speiserezepturen. Das Küchenpersonal ist instruiert, durch das Abdecken, das getrennte Lagern, das Vor- und Zubereiten von Lebensmitteln und das Einhalten von Rezepturen und Hygienevorschriften eine korrekte Allergenkennzeichnung sicherzustellen. Um Fehlerquellen aufzudecken und das Einhalten der Vorgaben sicherzustellen, werden alle Prozesse regelmäßig überprüft.</p>
			<ol start="12">
				<li><strong> Gibt es einen Notfallplan, sollte bei einem Gast dennoch eine allergische Reaktion auftreten?</strong></li>
			</ol>
			<p>Prinzipiell gelten auch für akute allergische Reaktionen immer die Regeln der Ersten Hilfe. Wichtig ist, dass jedem Mitarbeiter im Betrieb eine zentrale Telefonnummer bekannt ist, unter der ein Notarzt gerufen werden kann.</p>
			<ol start="13">
				<li><strong> Ich habe weitergehende Fragen. An wen kann ich mich wenden?</strong></li>
			</ol>
			<p>Bei Fragen wenden Sie sich bitten zunächst an unsere Köche an der Cafeteria. Bei weitergehenden (medizinischen) Fragen wenden Sie sich bitte an Ihren Haus- oder Facharzt.</p>
			<ol start="14">
				<li><strong> Wie werden die Gäste genau informiert?</strong></li>
			</ol>
			<p>Ziel der neuen Allergenkennzeichnungsverordnung ist es, den Allergiker schon vor seiner Kaufentscheidung und ohne zusätzliche Nachfrage darüber zu informieren, welche der 14 deklarationspflichtigen Allergene in der Speise enthalten sind.</p>
			<p>Die Gäste haben die Möglichkeit im Internet unsere Speisepläne einzusehen, um sich vorab zu informieren.</p>
		</div>
		<?php include 'footer.php' ?>
	</body>
</html>
