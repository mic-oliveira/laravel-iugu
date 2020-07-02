<?php


namespace Iugu\Tests;


use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

trait IuguTestTrait
{

    private function mockCustomerRequest($statusCode=200,$header=[],$data='',$method='POST',$uri='test')
    {
        if(empty($data)){
            $data='{
                "id": "D7AB9420A44340B1B3A2855067F16E44",
                "email": "flittel@stanton.org",
                "name": "Gilbert Stamm",
                "notes": "Libero dolores excepturi consectetur ipsam quis veritatis dolore. Quos beatae quis quia maiores ducimus. Neque tempore aut tenetur. Aut consequatur qui tempore quia vel fugit et at.",
                "created_at": "2020-06-07T19:24:21-03:00",
                "updated_at": "2020-06-07T19:24:21-03:00",
                "cc_emails": null,
                "cpf_cnpj": "14576487760",
                "zip_code": null,
                "number": null,
                "complement": null,
                "phone": null,
                "phone_prefix": null,
                "default_payment_method_id": null,
                "proxy_payments_from_customer_id": null,
                "city": null,
                "state": null,
                "district": null,
                "street": null,
                "custom_variables": []
            }';
        }
        $mock = new MockHandler([
            new Response($statusCode,$header,$data),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request($method, $uri))
        ]);
        return new HandlerStack($mock);
    }

    private function mockInvoiceRequest($statusCode=200,$header=[],$data='',$method='POST',$uri='test')
    {
        if(empty($data)){
            $data='{
                "id": "E33604A9FDFB42FEAABBACCDCF3AFBA9",
                "due_date": "2020-06-15",
                "currency": "BRL",
                "discount_cents": null,
                "email": "michaelferreira@intnet.com.br",
                "items_total_cents": 1000,
                "notification_url": null,
                "return_url": null,
                "status": "pending",
                "tax_cents": null,
                "total_cents": 1000,
                "total_paid_cents": 0,
                "taxes_paid_cents": null,
                "paid_at": null,
                "paid_cents": null,
                "cc_emails": null,
                "financial_return_date": null,
                "payable_with": "credit_card",
                "overpaid_cents": null,
                "ignore_due_email": null,
                "ignore_canceled_email": null,
                "advance_fee_cents": null,
                "commission_cents": null,
                "early_payment_discount": false,
                "order_id": null,
                "updated_at": "2020-06-10T17:14:17-03:00",
                "credit_card_brand": null,
                "credit_card_bin": null,
                "credit_card_last_4": null,
                "credit_card_captured_at": null,
                "credit_card_tid": null,
                "secure_id": "e33604a9-fdfb-42fe-aabb-accdcf3afba9-0844",
                "secure_url": "https://faturas.iugu.com/e33604a9-fdfb-42fe-aabb-accdcf3afba9-0844",
                "customer_id": "42EA44A7170E4B93AD1112337536D78D",
                "customer_ref": "Cliente Teste",
                "customer_name": "Cliente Teste",
                "user_id": null,
                "total": "R$ 10,00",
                "taxes_paid": "R$ 0,00",
                "total_paid": "R$ 0,00",
                "total_overpaid": "R$ 0,00",
                "total_refunded": "R$ 0,00",
                "commission": "R$ 0,00",
                "fines_on_occurrence_day": "R$ 0,00",
                "total_on_occurrence_day": "R$ 0,00",
                "fines_on_occurrence_day_cents": 0,
                "total_on_occurrence_day_cents": 0,
                "refunded_cents": 0,
                "advance_fee": null,
                "paid": "R$ 0,00",
                "original_payment_id": null,
                "double_payment_id": null,
                "per_day_interest": false,
                "per_day_interest_value": null,
                "interest": null,
                "discount": null,
                "created_at": "10/06, 17:10",
                "created_at_iso": "2020-06-10T17:10:46-03:00",
                "authorized_at": null,
                "authorized_at_iso": null,
                "expired_at": null,
                "expired_at_iso": null,
                "refunded_at": null,
                "refunded_at_iso": null,
                "canceled_at": null,
                "canceled_at_iso": null,
                "protested_at": null,
                "protested_at_iso": null,
                "chargeback_at": null,
                "chargeback_at_iso": null,
                "occurrence_date": null,
                "refundable": null,
                "installments": null,
                "transaction_number": 1111,
                "payment_method": null,
                "financial_return_dates": null,
                "bank_slip": null,
                "items": [
                    {
                        "id": "7C814980E5BE412E8866D1831E259545",
                        "description": "TESTE",
                        "price_cents": 1000,
                        "quantity": 1,
                        "created_at": "2020-06-10T17:10:46-03:00",
                        "updated_at": "2020-06-10T17:10:46-03:00",
                        "price": "R$ 10,00"
                    }
                ],
                "early_payment_discounts": [],
                "variables": [
                    {
                        "id": "5BC868821A044C84A507BA5C9C82E5B2",
                        "variable": "payer.address.city",
                        "value": "Araruama"
                    },
                    {
                        "id": "ED2E49318048475D8EA0A5661077051E",
                        "variable": "payer.address.complement",
                        "value": "debitis"
                    },
                    {
                        "id": "D51B97BE750B4D9C9D78BF2F09068415",
                        "variable": "payer.address.district",
                        "value": "vero"
                    },
                    {
                        "id": "C6BB247C3A364BA2A20D0A20EBB04C5F",
                        "variable": "payer.address.number",
                        "value": "Prof. Kellen Davis"
                    },
                    {
                        "id": "3B027B69759D4BDC90065A1D0A25A12B",
                        "variable": "payer.address.state",
                        "value": "RJ"
                    },
                    {
                        "id": "365CB0CF551544CFAD26CDF2868A0F41",
                        "variable": "payer.address.street",
                        "value": "kamron71@example.org"
                    },
                    {
                        "id": "4A2C85A27AB94C2FBE05A83587AA1F7C",
                        "variable": "payer.address.zip_code",
                        "value": "28970000"
                    },
                    {
                        "id": "58A6237F475C4859B1F5D03B07579146",
                        "variable": "payer.cpf_cnpj",
                        "value": "14576487760"
                    },
                    {
                        "id": "16E6665855894E12801F033043C5E05D",
                        "variable": "payer.name",
                        "value": "Cliente Teste"
                    },
                    {
                        "id": "DFB3A77F2BA14D6CA10DB17521211A0D",
                        "variable": "total_views",
                        "value": "2"
                    }
                ],
                "custom_variables": [],
                "logs": [
                    {
                        "id": "BC56526AF72043E68A63D5203FA63449",
                        "description": "Email de Lembrete enviado!",
                        "notes": "Lembrete enviado com sucesso para: michaelferreira@intnet.com.br",
                        "created_at": "12/06, 09:23"
                    },
                    {
                        "id": "4B694600602C456A9E2E96AC8A22C5D8",
                        "description": "Fatura visualizada!",
                        "notes": "Fatura visualizada!!",
                        "created_at": "10/06, 17:14"
                    },
                    {
                        "id": "04F38C2632EA4DD7B181FC2D811F05C5",
                        "description": "Fatura visualizada!",
                        "notes": "Fatura visualizada!!",
                        "created_at": "10/06, 17:13"
                    },
                    {
                        "id": "C0FB1CEDF7454EF5B7BEC9B7C2916A55",
                        "description": "Email de Lembrete enviado!",
                        "notes": "Lembrete enviado com sucesso para: michaelferreira@intnet.com.br",
                        "created_at": "10/06, 17:12"
                    },
                    {
                        "id": "78B89A9349284AFEA6A2750E9AF6E710",
                        "description": "Fatura criada com sucesso!",
                        "notes": "Fatura criada!",
                        "created_at": "10/06, 17:10"
                    },
                    {
                        "id": "B45315FF053044D2980754DC14F2D782",
                        "description": "Email de Lembrete enviado!",
                        "notes": "Lembrete enviado com sucesso para: michaelferreira@intnet.com.br",
                        "created_at": "10/06, 17:10"
                    }
                ]
            }';
        }
        $mock = new MockHandler([
            new Response($statusCode,$header,$data),
            new Response(200, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request($method, $uri))
        ]);
        return new HandlerStack($mock);
    }

    private function mockPlanRequest($statusCode=200,$header=[],$data='',$method='POST',$uri='test')
    {
        if(empty($data)) {
            $data = '{
                "id": "30702F77F08A46B9BA077E77F23036DA",
                "name": "Plano Test",
                "identifier": "plano_test",
                "interval": 1,
                "interval_type": "months",
                "created_at": "2020-06-19T10:30:50-03:00",
                "updated_at": "2020-06-19T10:33:47-03:00",
                "payable_with": "all"
            }';
        }
        $mock = new MockHandler([
            new Response($statusCode,$header,$data),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request($method, $uri))
        ]);
        return new HandlerStack($mock);
    }

    public function mockSubscriptionRequest($statusCode=200,$header=[],$data='',$method='POST',$uri='test')
    {
        if(empty($data)) {
            $data = '{
                "id": "723D0E7D64F84FBF95933A402DFC2E8E",
                "suspended": false,
                "plan_identifier": "plano_test",
                "price_cents": 100,
                "currency": "BRL",
                "features": {},
                "expires_at": null,
                "created_at": "2020-06-23T09:12:49-03:00",
                "updated_at": "2020-06-23T09:12:50-03:00",
                "customer_name": "Cliente Test",
                "customer_email": "teste@teste.com",
                "cycled_at": "2020-06-23",
                "credits_min": 0,
                "credits_cycle": null,
                "payable_with": "all",
                "ignore_due_email": null,
                "customer_id": "0DBB335ECFB44ACE8B4EDAF25037CAA4",
                "plan_name": "Plano Test",
                "customer_ref": "Cliente Test",
                "plan_ref": "Plano Test",
                "active": true,
                "two_step": true,
                "suspend_on_invoice_expired": true,
                "in_trial": null,
                "credits": 0,
                "credits_based": false,
                "recent_invoices": [
                    {
                        "id": "31033E0A2124472F970937DA65A5C31B",
                        "due_date": "2020-06-23",
                        "status": "pending",
                        "total": "R$ 1,00",
                        "secure_url": "https://faturas.iugu.com/31033e0a-2124-472f-9709-37da65a5c31b-89f8"
                    }
                ],
                "subitems": [],
                "logs": [
                    {
                        "id": "5267A39A21E24E969FC66222930FD357",
                        "description": "Fatura criada",
                        "notes": "Fatura criada com os items:  1x Ativação de Assinatura: Plano Test = R$ 1,00;",
                        "created_at": "2020-06-23T09:12:50-03:00"
                    },
                    {
                        "id": "72EEDE09E9CF4BE385728BF119B2F5C7",
                        "description": "Assinatura Criada",
                        "notes": "Assinatura Criada ",
                        "created_at": "2020-06-23T09:12:49-03:00"
                    }
                ],
                "custom_variables": []
            }';
        }
        $mock = new MockHandler([
            new Response($statusCode,$header,$data),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request($method, $uri))
        ]);
        return new HandlerStack($mock);
    }

    public function mockChargeRequest($statusCode=200,$header=[],$data='',$method='POST',$uri='test')
    {
        if(empty($data)) {
            $data = '{
                "message": "Autorizado",
                "errors": {},
                "success": true,
                "url": "https://faturas.iugu.com/9abc49c8-afc4-4cc0-ab66-47e7ae5ab726-13f3",
                "pdf": "https://faturas.iugu.com/9abc49c8-afc4-4cc0-ab66-47e7ae5ab726-13f3.pdf",
                "identification": null,
                "invoice_id": "9ABC49C8AFC44CC0AB6647E7AE5AB726",
                "LR": "00"
            }';
        }
        $mock = new MockHandler([
            new Response($statusCode,$header,$data),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request($method, $uri))
        ]);
        return new HandlerStack($mock);
    }
}
