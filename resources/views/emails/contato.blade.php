<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo E-mail de contato - FinPlan</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f7f7f7; margin: 0; padding: 0;">
    <table width="100%" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" bgcolor="#ffffff" cellpadding="30" cellspacing="0" style="border-radius: 10px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);">
                    <tr>
                        <td align="center" style="border-bottom: 1px solid #e0e0e0;">
                            <h2 style="color: #11999E; margin: 0 0 10px 0;">Nova Mensagem de Contato</h2>
                            <p style="color: #555; margin: 0;">Você recebeu uma nova mensagem pelo formulário de contato do site FinPlan</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 8px 0; color: #333;"><strong>Nome:</strong></td>
                                    <td style="padding: 8px 0; color: #555;">{{ $informations['firstNameContact'] ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #333;"><strong>Sobrenome:</strong></td>
                                    <td style="padding: 8px 0; color: #555;">{{ $informations['lastnameContact'] ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #333;"><strong>E-mail:</strong></td>
                                    <td style="padding: 8px 0; color: #555;">{{ $informations['emailContact'] ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #333;"><strong>Telefone:</strong></td>
                                    <td style="padding: 8px 0; color: #555;">{{ $informations['phoneContact'] ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #333;"><strong>Mensagem:</strong></td>
                                    <td style="padding: 8px 0; color: #555;">{{ $informations['messageContact'] ?? 'Não informado' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="border-top: 1px solid #e0e0e0; padding-top: 20px; color: #888; font-size: 13px;">
                            <p style="margin: 0;">FinPlan &copy; {{ date('Y') }}<br>Mensagem de contato da FinPlan.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>