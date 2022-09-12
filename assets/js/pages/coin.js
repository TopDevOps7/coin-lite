(() => {
  "use strict";

  const CoinLite = window.CoinLite;
  const DATA = window.DATA;
  const $ = window.jQuery;
  const echarts = window.echarts;

  const $coin = $("#coin");

  const Coin = {
    pricesSocket: null,
    chartInstance: null,
  };

  Coin.initPricesSocket = function () {
    this.pricesSocket = new WebSocket("wss://ws.coincap.io/prices?assets=" + $coin.data("id"));
    this.pricesSocket.addEventListener("message", (event) => {
      const data = JSON.parse(event.data);
      if (data) {
        Object.keys(data).forEach((id) => {
          const price = CoinLite.priceFormat(CoinLite.convertFromUSD(data[id]));
          $("#coin-price").text(price);
        });
      }
    });
  };

  Coin.buildChart = function (days) {
    $("button[data-days]").removeClass("selected");

    if (this.chartInstance) this.chartInstance.showLoading();
    if ($coin.data("id") == "redux") {
      let data = [];
      let data_ = [];
      let startDate = new Date("September 01, 2022 00:00:00");
      let startValue = startDate.getTime();
      let endDate = new Date();
      let endValue = endDate.getTime();
      $("#coin-price").text("$0.20");

      switch (days) {
        case 1:
          while (startValue < endValue) {
            data_.push([startValue, 0.2]);
            startValue += 300000;
          }
          data_.map((ele, i) => {
            if (i > data_.length - 290) {
              data.push(ele);
            }
          });
          break;

        case 7:
          while (startValue < endValue) {
            data_.push([startValue, 0.2]);
            startValue += 3600000;
          }
          data_.map((ele, i) => {
            if (i > data_.length - 170) {
              data.push(ele);
            }
          });
          break;

        case 30:
          while (startValue < endValue) {
            data_.push([startValue, 0.2]);
            startValue += 3600000;
          }
          data_.map((ele, i) => {
            data.push(ele);
          });
          break;

        case 180:
          while (startValue < endValue) {
            data_.push([startValue, 0.2]);
            startValue += 3600000;
            //   startValue += 86400000;
          }
          data_.map((ele, i) => {
            data.push(ele);
          });
          break;

        case 365:
          while (startValue < endValue) {
            data_.push([startValue, 0.2]);
            startValue += 3600000;
          }
          data_.map((ele, i) => {
            data.push(ele);
          });
          break;

        case "max":
          while (startValue < endValue) {
            data_.push([startValue, 0.2]);
            startValue += 3600000;
          }
          data_.map((ele, i) => {
            data.push(ele);
          });
          break;

        default:
          break;
      }
      const options = {
        title: {
          show: false,
          text: $coin.data("name"),
        },
        animation: false,
        backgroundColor: "rgba(0,0,0,0)",
        tooltip: {
          trigger: "axis",
          axisPointer: { type: "cross" },
          backgroundColor: "rgba(255,255,255,0.9)",
          confine: true,
          formatter: (params) => {
            let html = "";
            html += CoinLite.chartTooltipDateFormat(params[0].axisValue);
            html += " : ";
            html += CoinLite.priceFormat(params[0].value);
            return html;
          },
        },
        axisPointer: {
          label: {
            formatter: (params) => {
              return params.axisDimension === "y"
                ? CoinLite.chartYAxisValueFormat(params.value)
                : CoinLite.chartXAxisDateFormat(params.value, days);
            },
          },
        },
        toolbox: {
          feature: {
            restore: { show: false },
            saveAsImage: { title: "" },
          },
          right: 8,
        },
        grid: {
          left: "2%",
          right: "2%",
          containLabel: true,
        },
        yAxis: {
          type: "value",
          axisTick: { show: false },
          axisLine: { show: false },
          axisLabel: {
            show: true,
            inside: true,
            formatter: (value) => CoinLite.chartYAxisValueFormat(value) + "\n\n",
          },
          scale: true,
        },
        xAxis: {
          type: "category",
          boundaryGap: false,
          scale: true,
          splitLine: {
            show: false,
          },
          axisLabel: {
            inside: false,
            showMinLabel: false,
            formatter: (value) => CoinLite.chartXAxisDateFormat(value, days),
          },
          data: data.map((p) => p[0]),
        },
        series: [
          {
            id: "price",
            type: "line",
            showSymbol: false,
            itemStyle: {
              color: DATA.theme.chart_color,
            },
            areaStyle: {},
            data: data.map((p) => p[1]),
          },
        ],
      };

      if (this.chartInstance) this.chartInstance.dispose();

      this.chartInstance = echarts.init($("#coin-chart")[0]);
      this.chartInstance.setOption(options);

      $('button[data-days="' + days + '"').addClass("selected");
    } else {
      fetch(
        "https://api.coingecko.com/api/v3/coins/" +
          $coin.data("id") +
          "/market_chart?vs_currency=" +
          DATA.currency.toLowerCase() +
          "&days=" +
          days
      )
        .then((res) => res.json())
        .then((data) => {
          const options = {
            title: {
              show: false,
              text: $coin.data("name"),
            },
            animation: false,
            backgroundColor: "rgba(0,0,0,0)",
            tooltip: {
              trigger: "axis",
              axisPointer: { type: "cross" },
              backgroundColor: "rgba(255,255,255,0.9)",
              confine: true,
              formatter: (params) => {
                let html = "";
                html += CoinLite.chartTooltipDateFormat(params[0].axisValue);
                html += " : ";
                html += CoinLite.priceFormat(params[0].value);
                return html;
              },
            },
            axisPointer: {
              label: {
                formatter: (params) => {
                  return params.axisDimension === "y"
                    ? CoinLite.chartYAxisValueFormat(params.value)
                    : CoinLite.chartXAxisDateFormat(params.value, days);
                },
              },
            },
            toolbox: {
              feature: {
                restore: { show: false },
                saveAsImage: { title: "" },
              },
              right: 8,
            },
            grid: {
              left: "2%",
              right: "2%",
              containLabel: true,
            },
            yAxis: {
              type: "value",
              axisTick: { show: false },
              axisLine: { show: false },
              axisLabel: {
                show: true,
                inside: true,
                formatter: (value) => CoinLite.chartYAxisValueFormat(value) + "\n\n",
              },
              scale: true,
            },
            xAxis: {
              type: "category",
              boundaryGap: false,
              scale: true,
              splitLine: {
                show: false,
              },
              axisLabel: {
                inside: false,
                showMinLabel: false,
                formatter: (value) => CoinLite.chartXAxisDateFormat(value, days),
              },
              data: data.prices.map((p) => p[0]),
            },
            series: [
              {
                id: "price",
                type: "line",
                showSymbol: false,
                itemStyle: {
                  color: DATA.theme.chart_color,
                },
                areaStyle: {},
                data: data.prices.map((p) => p[1]),
              },
            ],
          };

          if (this.chartInstance) this.chartInstance.dispose();

          this.chartInstance = echarts.init($("#coin-chart")[0]);
          this.chartInstance.setOption(options);

          $('button[data-days="' + days + '"').addClass("selected");
        });
    }
  };

  Coin.initTickers = function () {
    const $table = $("#coin-tickers-table");

    fetch("https://api.coingecko.com/api/v3/coins/" + $coin.data("id") + "/tickers?include_exchange_logo=true&order=volume_desc")
      .then((res) => res.json())
      .then((data) => {
        if (!data || !data.tickers) {
          $table.hide();
          return;
        }

        const tickers = data.tickers.map((ticker) => {
          return {
            base: ticker.base,
            target: ticker.target,
            pair: ticker.base + "/" + ticker.target,
            exchange_id: ticker.market.identifier,
            exchange: ticker.market.name,
            image: ticker.market.logo,
            url: CoinLite.referralUrl(ticker.market.identifier, ticker.trade_url) ?? "",
            last: ticker.last,
            volume: ticker.volume,
            volume_usd: ticker.converted_volume.usd,
            spread: ticker.bid_ask_spread_percentage,
            trust_score: ticker.trust_score,
          };
        });

        $table.DataTable({
          data: tickers,
          scrollX: true,
          deferRender: true,
          pageLength: 25,
          pagingType: "numbers",
          order: [[4, "desc"]],
          language: DATA.datatables.language,
          columns: [
            {
              data: "exchange",
              searchable: true,
              render: (data, type, row, meta) => {
                if (type === "display") {
                  const url = DATA.urls.exchanges + "/" + row.exchange_id;
                  const image = row.image ? row.image : DATA.urls.logo;
                  return (
                    '<a href="' +
                    url +
                    '">' +
                    "<h6>" +
                    '<img src="' +
                    image +
                    '" width="24" height="24">' +
                    " <span>" +
                    data +
                    "</span>" +
                    "</h6>" +
                    "</a>"
                  );
                } else {
                  return data;
                }
              },
            },
            {
              data: "pair",
              searchable: true,
              render: (data, type, row, meta) => {
                if (type === "display") {
                  return (
                    '<a href="' +
                    row.url +
                    '">' +
                    CoinLite.symbolDisplay(row.base) +
                    "/" +
                    CoinLite.symbolDisplay(row.target) +
                    "</a>"
                  );
                } else {
                  return data;
                }
              },
            },
            {
              data: "last",
              searchable: false,
              className: "text-end",
              render: (data, type, row, meta) => {
                if (type === "display") {
                  return (
                    '<a href="' + row.url + '">' + CoinLite.priceFormatWithUnit(data, CoinLite.symbolDisplay(row.target)) + "</a>"
                  );
                } else {
                  return data;
                }
              },
            },
            {
              data: "spread",
              searchable: false,
              className: "text-end",
              render: (data, type, row, meta) => {
                if (type === "display") {
                  return '<a href="' + row.url + '">' + CoinLite.spreadFormat(data) + "</a>";
                } else {
                  return data;
                }
              },
            },
            {
              data: "volume",
              searchable: false,
              className: "text-end",
              render: (data, type, row, meta) => {
                if (type === "display") {
                  return (
                    '<a href="' +
                    row.url +
                    '">' +
                    CoinLite.largePriceFormatWithUnit(data, CoinLite.symbolDisplay(row.base)) +
                    "</a>"
                  );
                } else if (type === "sort") {
                  return row.volume_usd;
                } else {
                  return data;
                }
              },
            },
            {
              data: "volume_usd",
              searchable: false,
              className: "text-end",
              render: (data, type, row, meta) => {
                if (type === "display") {
                  return '<a href="' + row.url + '">' + CoinLite.largePriceFormat(CoinLite.convertFromUSD(data)) + "</a>";
                } else {
                  return data;
                }
              },
            },
            {
              data: "trust_score",
              searchable: false,
              className: "text-center",
              render: (data, type, row, meta) => {
                if (type === "display") {
                  return '<span class="score circle ' + data + '"></span>';
                } else {
                  switch (data) {
                    case "green":
                      return 10;
                    case "yellow":
                      return 5;
                    case "red":
                      return 1;
                  }
                  return 0;
                }
              },
            },
          ],
        });
      })
      .catch(() => $table.hide());
  };

  Coin.init = function () {
    $("button[data-days]").on("click", function () {
      const $this = $(this);
      Coin.buildChart($this.data("days"));
    });

    $(window).on("resize", () => {
      if (this.chartInstance) this.chartInstance.resize();
    });

    this.initPricesSocket();
    this.buildChart(7);
    this.initTickers();
  };

  Coin.init();
})(window);
