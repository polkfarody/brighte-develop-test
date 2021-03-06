<?php

namespace App\Tests;

class DummyJson {
    public static $valid = <<<JSON
[
  {
    "customer":{
      "name":"Johnny Bravo",
      "address":"56 Pitt Street, 2000, Sydney"
    },
    "deliveryType":"personalDelivery",
    "source":"web",
    "weight":1500
  },
  {
    "customer":{
      "name":"Jack Ripper",
      "address":"822 Anzac Parade, 2035, Maroubra"
    },
    "deliveryType":"personalDeliveryExpress",
    "source":"email",
    "weight":2000,
    "campaign":{
      "name":"Christmas2018",
      "type":"holiday",
      "ad":"opportunity"
    }
  },
  {
    "customer":{
      "name":"Elvis Presley",
      "address":"333 George Street, 2000, Sydney"
    },
    "deliveryType":"enterpriseDelivery",
    "source":"direct",
    "onBehalf":"True Capital",
    "enterprise":{
      "name":"Bayview Motel",
      "type":"PtyLtd",
      "abn":"SN123OK",
      "directors":[
        {
          "name":"Michael Jackskon",
          "address":"242 Bayview, 2434, Sydney"
        },
        {
          "name":"Freddie Mercury",
          "address":"132 Coast, 2354, Newcastle"
        }
      ]
    },
    "weight":5000
  }
]
JSON;

    public static $empty = <<<JSON
[]
JSON;

    public static $invalid = <<<JSON
[
{
"customer":{
  "name":"Johnny Bravo",
  "address":"56 Pitt Street, 2000, Sydney"
},
"deliveryType":"personalDeliveries",
"weight":1500
}
]
JSON;

    public static $invoiceJson = <<<JSON
[{"invoiceId":18,"invoiceNo":"INV0000000018","deliveryOrder":{"customer":{"name":"Sally","address":"Address"},"deliveryType":"personalDelivery","source":"The Source","weight":300},"billingInfo":"Address"}]
JSON;
}
