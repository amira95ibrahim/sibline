
//codes for value chart
var revenueOptions = {
    colors: ['#ffc600'],
    chart: {
        maxWidth: 250,
        height: 100,
        type: "area",
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
    },
    dataLabels: {
        enabled: false
    },
    series: [
      {
        name: "Monthly Value",
        data: revenues_data
      }
    ],
    fill: {
      type: "gradient",
      colors: ['#ffc600'],
        gradient: {
            shadeIntensity: 0.5,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [50, 100]
        }
    },
    stroke: {
        curve: 'smooth',
        colors: ['#ffc600'],
        width: 3,
    },
    markers: {
        size: 0,
        hover: {
          size: 5,
          colors: ['#ffc600']
        }
    },
    xaxis: {
        show: false,
        axisTicks: {
            show: false
        },
      categories: revenues_categories,
      lables: {
          show: false
      }
    },
    yaxis: {
        show: false
    }
};

var valChart = document.getElementById("valueChart");
if(valChart != null) { 
    var chartOne = new ApexCharts(
        document.querySelector("#valueChart"),
        revenueOptions);
    chartOne.render(); 
}

//codes for balance chart
var balanceOptions = {
    colors: ['#12CCA9'],
    chart: {
        maxWidth: 250,
        height: 100,
        type: "area",
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
    },
    dataLabels: {
        enabled: false
    },
    series: [
      {
        name: "Monthly Value",
        data: expenses_data
      }
    ],
    fill: {
      type: "gradient",
      colors: ['#12CCA9'],
        gradient: {
            shadeIntensity: 0.5,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [50, 100]
        }
    },
    stroke: {
        curve: 'smooth',
        colors: ['#12CCA9'],
        width: 3,
    },
    markers: {
        size: 0,
        hover: {
          size: 5,
          colors: ['#12CCA9']
        }
    },
    xaxis: {
        show: false,
        axisTicks: {
            show: false
        },
      categories: expenses_categories,
      lables: {
          show: false
      }
    },
    yaxis: {
        show: false
    }
};

var balChart = document.getElementById("balanceChart");
if(balChart != null) { 
    var chartTwo = new ApexCharts(
        document.querySelector("#balanceChart"),
        balanceOptions);
    chartTwo.render();
}


//codes for earnings chart
var earningOptions = {
    colors: ['#A05BFF'],
    chart: {
        maxWidth: 250,
        height: 100,
        type: "area",
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
    },
    dataLabels: {
        enabled: false
    },
    series: [
      {
        name: "Monthly Value",
        data: orders_data
      }
    ],
    fill: {
      type: "gradient",
      colors: ['#A05BFF'],
        gradient: {
            shadeIntensity: 0.5,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [50, 100]
        }
    },
    stroke: {
        curve: 'smooth',
        colors: ['#A05BFF'],
        width: 3,
    },
    markers: {
        size: 0,
        hover: {
          size: 5,
          colors: ['#A05BFF']
        }
    },
    xaxis: {
        show: false,
        axisTicks: {
            show: false
        },
      categories: orders_categories,
      lables: {
          show: false
      }
    },
    yaxis: {
        show: false
    }
};

var earnChart = document.getElementById("earningsChart");
if(earnChart != null) { 
    var chartThree = new ApexCharts(
        document.querySelector("#earningsChart"),
        earningOptions);
    chartThree.render();
}





//fantasy charts start
var fantasyOptions = {
  series: [{
    name: "Monthly Investment",
    data: [10, 19, 29, 10,36, 26, 39]
}],
  chart: {
    width: '100%',
    height: '250px',
    type: 'line',
  zoom: {
    enabled: false
  },
  toolbar: {
    show: false
  }
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  curve: 'straight',
  colors: '#007AD8',
  width: 3,
  dashArray: 0,      
},
grid: {
  padding: {
    top: 0,
    right: 0,
    left: 15,
  }
},
xaxis: {
  categories: ['Jan 2020', 'Feb 2020', 'Mar2020', 'Apr 2020', 'May 2021', 'Jun 2021', 'Jul 2021' ],
  labels: {
    style: {
        colors: '#B2B8E4',
        fontSize: '10px',
        fontFamily: '$open-sans',
        fontWeight: 700,
        lineHeight: 2
    },
    axisBorder: {
      show: false
    }
  }
},
yaxis: {
  labels: {
    style: {
        colors: '#B2B8E4',
        fontSize: '10px',
        fontFamily: '$open-sans',
        fontWeight: 700,
        lineHeight: 2
    }
  }
},
markers: {
  size: 0,
  colors: '#04c1ff',
  strokeColors: '#fff',
  strokeWidth: 4,
  shape: "circle",
  hover: {
    size: 6,
    strokeWidth: 4,
  }
},
responsive: [{
  breakpoint: 575,
  options: {
    grid: {
      padding: {
        top: 0,
        right: 0,
        left: 0,
      }
    },
  }
}]
};

var fanChart = document.getElementById("fantasyChart");
if(fanChart != null) { 
  var fantasy = new ApexCharts(
      document.querySelector("#fantasyChart"),
      fantasyOptions);
      fantasy.render();
}


//Price charts start
var priceOptions = {
  series: [{
    name: "Monthly Investment",
    data: [10, 19, 29, 10,36, 26, 39]
}],
  chart: {
    width: '100%',
    height: '250px',
    type: 'line',
  zoom: {
    enabled: false
  },
  toolbar: {
    show: false
  }
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  curve: 'straight',
  colors: '#007AD8',
  width: 3,
  dashArray: 0,      
},
grid: {
  padding: {
    top: 0,
    right: 0,
    left: 15,
  }
},
xaxis: {
  categories: ['Jan 2020', 'Feb 2020', 'Mar2020', 'Apr 2020', 'May 2021', 'Jun 2021', 'Jul 2021' ],
  labels: {
    style: {
        colors: '#B2B8E4',
        fontSize: '10px',
        fontFamily: '$open-sans',
        fontWeight: 700,
        lineHeight: 2
    },
    axisBorder: {
      show: false
    }
  }
},
yaxis: {
  labels: {
    style: {
        colors: '#B2B8E4',
        fontSize: '10px',
        fontFamily: '$open-sans',
        fontWeight: 700,
        lineHeight: 2
    }
  }
},
markers: {
  size: 0,
  colors: '#04c1ff',
  strokeColors: '#fff',
  strokeWidth: 4,
  shape: "circle",
  hover: {
    size: 6,
    strokeWidth: 4,
  }
},
responsive: [{
  breakpoint: 575,
  options: {
    grid: {
      padding: {
        top: 0,
        right: 0,
        left: 0,
      }
    },
  }
}]
};

var priChart = document.getElementById("priceChart");
if(priChart != null) { 
  var price = new ApexCharts(
      document.querySelector("#priceChart"),
      priceOptions);
      price.render();
}



//property Type charts start
var propertyTypeOptions = {
  series: [44, 55, 13, 43, 22],
  chart: {
  width: 380,
  type: 'pie',
},
labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
      width: 200
    },
    legend: {
      position: 'bottom'
    }
  }
}]
};

var propertyTypeChart = document.getElementById("propertyTypeChart");
if(propertyTypeChart != null) { 
  var propertyType = new ApexCharts(
      document.querySelector("#propertyTypeChart"),
      propertyTypeOptions);
      propertyType.render();
}


var countriesOptions = {
    series: [{
    name: 'Inflation',
    data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
  }],
    chart: {
    height: 350,
    type: 'bar',
  },
  plotOptions: {
    bar: {
      borderRadius: 10,
      dataLabels: {
        position: 'top', // top, center, bottom
      },
    }
  },
  dataLabels: {
    enabled: true,
    formatter: function (val) {
      return val + "%";
    },
    offsetY: -20,
    style: {
      fontSize: '12px',
      colors: ["#304758"]
    }
  },

  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    position: 'top',
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false
    },
    crosshairs: {
      fill: {
        type: 'gradient',
        gradient: {
          colorFrom: '#D8E3F0',
          colorTo: '#BED1E6',
          stops: [0, 100],
          opacityFrom: 0.4,
          opacityTo: 0.5,
        }
      }
    },
    tooltip: {
      enabled: true,
    }
  },
  yaxis: {
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false,
    },
    labels: {
      show: false,
      formatter: function (val) {
        return val + "%";
      }
    }

  },
  title: {
    text: 'Monthly Inflation in Argentina, 2002',
    floating: true,
    offsetY: 330,
    align: 'center',
    style: {
      color: '#444'
    }
  }
  };

var countriesChart = document.getElementById("countriesChart");
if(countriesChart != null) { 
  var countries = new ApexCharts(
      document.querySelector("#countriesChart"),
      countriesOptions);
      countries.render();
}


var bidOptions = {
    series: [{
    name: 'Net Profit',
    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
  }, {
    name: 'Revenue',
    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
  }, {
    name: 'Free Cash Flow',
    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
  }],
    chart: {
    type: 'bar',
    height: 350
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded'
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
  },
  yaxis: {
    title: {
      text: '$ (thousands)'
    }
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands"
      }
    }
  }
  };

var bidChart = document.getElementById("bidChart");
if(bidChart != null) { 
  var bid = new ApexCharts(
      document.querySelector("#bidChart"),
      bidOptions);
      bid.render();
}


var offerOptions = {
  series: [{
  name: 'Net Profit',
  data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
}, {
  name: 'Revenue',
  data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
}, {
  name: 'Free Cash Flow',
  data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
}],
  chart: {
  type: 'bar',
  height: 350
},
plotOptions: {
  bar: {
    horizontal: false,
    columnWidth: '55%',
    endingShape: 'rounded'
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  width: 2,
  colors: ['transparent']
},
xaxis: {
  categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
},
yaxis: {
  title: {
    text: '$ (thousands)'
  }
},
fill: {
  opacity: 1
},
tooltip: {
  y: {
    formatter: function (val) {
      return "$ " + val + " thousands"
    }
  }
}
};

var offerChart = document.getElementById("offerChart");
if(offerChart != null) { 
var offer = new ApexCharts(
    document.querySelector("#offerChart"),
    offerOptions);
    offer.render();
}
  