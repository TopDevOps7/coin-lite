(() => {
  "use strict";

  const CoinLite = window.CoinLite;
  const DATA = window.DATA;
  const $ = window.jQuery;

  const Coins = {
    pricesSocket: null,
  };

  Coins.initPricesSocket = function () {
    this.pricesSocket = new WebSocket("wss://ws.coincap.io/prices?assets=ALL");
    this.pricesSocket.addEventListener("message", (event) => {
      const highlightClass = "table-highlight-color";
      const data = JSON.parse(event.data);
      if (data) {
        Object.keys(data).forEach((id) => {
          const $row = $('tr[data-id="' + id + '"');
          $row.addClass(highlightClass);
          $row.find(".price").text(CoinLite.priceFormat(CoinLite.convertFromUSD(data[id])));
          setTimeout(() => $row.removeClass(highlightClass), 1000);
        });
      }
    });
  };

  Coins.initTable = function () {
    $.ajax({
      url: DATA.urls.api + "/coins?currency=" + DATA.currency,
      success: function (result) {
        $("#top-coins").html("");
        let str = "";
        let total_volume = 0;
        let total_market_cap = 0;
        result.data.map((ele, i) => {
          if (i < 3) {
            str += `<div class="col-12 col-xxl-4 col-lg-4 col-md-6" style="padding: 7px 15px">
              <div style="border: solid 2px; border-radius: 10px; padding: 15px; border-color: #4358A4">
                <div style="display: flex; justify-content: space-between">
                  <div><img src="${ele.image}" width="50" height="50"><span style="margin-left: 10px; font-weight: bold">${
              ele.name
            }</span></div>
                  <div><span style="background: #939399; border-radius: 5px; padding: 1px 8px 2px 8px; font-size: 12px; font-weight: 600; color: #FFFFFF">24h</span></div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 15px; font-weight: bold">
                  <div style="color: #2899C1"><span style="font-size: 24px">${CoinLite.priceFormat(
                    ele.price
                  )}</span><span style="margin-left: 5px">USD</span></div>
                  <div style="padding-top: 10px"><span class="${CoinLite.changeClass(ele.change_24h)}">${CoinLite.changeFormat(
              ele.change_24h
            )}</span></div>
                </div>
              </div>
            </div>`;
          }
          total_volume += ele.volume_24h;
          total_market_cap += ele.market_cap;
        });

        let total_number_of_coins = result.data.length;

        $("#total_market_cap").html(CoinLite.largePriceFormat(total_market_cap));
        $("#total_volume").html(CoinLite.largePriceFormat(total_volume));
        $("#total_coins").html(total_number_of_coins.toLocaleString());
        $("#top-coins").html(str);
      },
    });

    $("#coins-table").DataTable({
      ajax: DATA.urls.api + "/coins?currency=" + DATA.currency,
      scrollX: true,
      deferRender: true,
      pageLength: 100,
      pagingType: "numbers",
      language: DATA.datatables.language,
      columns: [
        {
          data: "rank",
          searchable: false,
        },
        {
          data: "name",
          searchable: true,
          render: (data, type, row, meta) => {
            if (type === "display") {
              const url = DATA.urls.coins + "/" + row.id;
              return (
                '<a href="' +
                url +
                '">' +
                "<h6>" +
                '<img src="' +
                row.image +
                '" width="24" height="24">' +
                " <span>" +
                row.name +
                '</span> <span class="badge bg-light text-black">' +
                row.symbol +
                "</span>" +
                "</h6>" +
                "</a>"
              );
            } else if (type === "filter") {
              return row.name + " " + row.symbol;
            } else {
              return data;
            }
          },
        },
        {
          data: "price",
          searchable: false,
          className: "text-end",
          render: (data, type, row, meta) => {
            if (type === "display") {
              const url = DATA.urls.coins + "/" + row.id;
              const format_data = data == 0.2 ? CoinLite.priceFormat(data).replace("0.2000", "0.20") : CoinLite.priceFormat(data);
              return '<a class="price" href="' + url + '">' + format_data + "</a>";
            } else {
              return data;
            }
          },
        },
        {
          data: "market_cap",
          searchable: false,
          className: "text-end",
          render: (data, type, row, meta) => {
            if (type === "display") {
              const url = DATA.urls.coins + "/" + row.id;
              const format_data =
                data == 400000000 ? CoinLite.largePriceFormat(data).replace("400.0", "400.00") : CoinLite.largePriceFormat(data);
              return '<a href="' + url + '">' + format_data + "</a>";
            } else {
              return data;
            }
          },
        },
        {
          data: "change_24h",
          searchable: false,
          className: "text-end",
          render: (data, type, row, meta) => {
            if (type === "display") {
              const url = DATA.urls.coins + "/" + row.id;
              return '<a href="' + url + '" class="' + CoinLite.changeClass(data) + '">' + CoinLite.changeFormat(data) + "</a>";
            } else {
              return data;
            }
          },
        },
      ],
      createdRow: (row, data, dataIndex, cells) => {
        row.dataset.id = data.id;
      },
    });
  };

  Coins.init = function () {
    this.initTable();
    this.initPricesSocket();
  };

  Coins.init();
})(window);
