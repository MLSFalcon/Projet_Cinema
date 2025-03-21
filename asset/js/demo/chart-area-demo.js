window.onload = function () {
  // Vérifier si Chart.js est bien chargé
  if (typeof Chart === "undefined") {
    console.error("Chart.js n'est pas chargé !");
    return;
  }

  // Définition des styles par défaut
  if (Chart.defaults) {
    Chart.defaults.font.family = 'Nunito, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif';
    Chart.defaults.color = "#858796";
  } else {
    console.error("Chart.defaults est introuvable !");
    return;
  }

  console.log("✅ Chart.js est bien chargé !");

  // Sélection de l'élément Canvas
  var ctx = document.getElementById("myAreaChart");

  if (!ctx) {
    console.error("Erreur : #myAreaChart introuvable !");
    return;
  }

  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      datasets: [{
        label: "Revenue",
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        data: [1000, 2000, 3000, 4000, 5000, 6000],
      }],
    },
    options: {
      maintainAspectRatio: false,
    }
  });
};
