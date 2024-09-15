import * as bootstrap from "bootstrap";
import ApexCharts from "apexcharts";
window.bootstrap = bootstrap;

import { Chart, registerables } from "chart.js";

Chart.register(...registerables);

const tanks = document.querySelectorAll(".tank-level-chart");

tanks.forEach((tank) => {
    const percentage = tank.getAttribute("data-percentage");
});
